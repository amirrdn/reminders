export default function authHeader() {
    let user = JSON.parse(localStorage.getItem('user'));
    let accessToken = localStorage.getItem('accessToken');

    if (user && accessToken) {
        return {
            Authorization: 'Bearer ' + accessToken
        }; 
    } else {
        return {};
    }
}