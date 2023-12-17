import axios from 'axios';

const API_URL = 'http://localhost/api/';

class AuthService {
    login(user) {
        return axios
            .post(API_URL + 'auth', {
                email: user.email,
                password: user.password
            },{ headers: { 
                "Access-Control-Allow-Origin": "*", 
                "Access-Control-Allow-Credentials": "false",
                "content-type": "application/json",
                "Access-Control-Allow-Methods": "DELETE, POST, GET, OPTIONS",
                "Access-Control-Allow-Headers": "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With",
                'crossdomain': true
            }})
            .then(response => {
                if (response.data.access_token) {
                    localStorage.setItem('user', JSON.stringify(response.data.data.users));
                    localStorage.setItem('accessToken', response.data.access_token);
                }
                const data ={
                    user: response.data.data.users,
                    permission: response.data.permissions
                }
                return data;
            });
    }

    logout() {
        localStorage.removeItem('user');
    }
}

export default new AuthService();