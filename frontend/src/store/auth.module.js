import AuthService from '../services/auth.service';

const user = JSON.parse(localStorage.getItem('user'));
const permission = JSON.parse(localStorage.getItem('permission'));
const initialState = user ?
    {
        status: {
            loggedIn: true
        },
        user, permission
    } :
    {
        status: {
            loggedIn: false
        },
        user: null,
        permission: null
    };

export const auth = {
    namespaced: true,
    state: initialState,
    actions: {
        login({
            commit
        }, user, permission) {
            return AuthService.login(user).then(
                user => {
                    console.log(permission)
                    commit('loginSuccess', permission === undefined ? user.user : user, permission === undefined ? user.permission : permission);
                    return Promise.resolve(user);
                },
                error => {
                    commit('loginFailure');
                    return Promise.reject(error);
                }
            );
        },
        logout({
            commit
        }) {
            AuthService.logout();
            commit('logout');
        },
        register({
            commit
        }, user) {
            return AuthService.register(user).then(
                response => {
                    commit('registerSuccess');
                    return Promise.resolve(response.data);
                },
                error => {
                    commit('registerFailure');
                    return Promise.reject(error);
                }
            );
        }
    },
    mutations: {
        loginSuccess(state, user, permission) {
            state.status.loggedIn = true;
            state.user = user;
            state.permission = permission;
        },
        loginFailure(state) {
            state.status.loggedIn = false;
            state.user = null;
        },
        logout(state) {
            state.status.loggedIn = false;
            state.user = null;
        },
        registerSuccess(state) {
            state.status.loggedIn = false;
        },
        registerFailure(state) {
            state.status.loggedIn = false;
        }
    }
};