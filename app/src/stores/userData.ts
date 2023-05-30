import { ref, computed } from "vue";
import { defineStore } from "pinia";
import axios from "axios";

export const useUserInfo = defineStore("UserInfo", {
    state: () => {
        return {
            UserToken: "",
            UserData: {
                name: "",
                surname: "",
                email: "",
            },
            LoggedIn: false,
            companies: { data: [] },
        };
    },
    getters: {
        getLoggedIn(): boolean {
            return this.LoggedIn || localStorage.getItem("Logged") !== null;
        },
        getUserToken(): any {
            return this.UserToken || localStorage.getItem("UserToken");
        },
    },
    actions: {
        async login(pass: string, mail: string) {
            try {
                await axios({
                    url: "/auth/login",
                    method: "post",
                    data: {
                        login: mail,
                        password: pass,
                    },
                }).then((response) => {
                    console.log(response);
                    this.UserToken = response.data.data.token;
                    this.UserData = response.data.data.user;
                    localStorage.setItem("Username", this.UserData.name);
                    localStorage.setItem("UserSurname", this.UserData.surname);
                    localStorage.setItem("E-mail", this.UserData.email);
                    localStorage.setItem("UserToken", this.UserToken);
                    this.LoggedIn = true;
                    localStorage.setItem(
                        "Logged",
                        JSON.stringify(this.LoggedIn)
                    );
                    console.log(this.UserToken);
                });
            } catch (errors) {
                alert(errors)
                console.log(errors);
            }
        },
        async register(
            name: string,
            surname: string,
            email: string,
            password: string,
            password_confirm: string
        ) {
            try {
                await axios({
                    method: "post",
                    url: "/auth/signup",
                    data: {
                        name: name,
                        surname: surname,
                        email: email,
                        password: password,
                        password_confirm: password_confirm,
                    },
                }).then((response) => {
                    console.log(response);
                    this.UserToken = response.data.data.token;
                    this.UserData = response.data.data.user;
                    localStorage.setItem("Username", this.UserData.name);
                    localStorage.setItem("UserSurname", this.UserData.surname);
                    localStorage.setItem("E-mail", this.UserData.email);
                    localStorage.setItem("UserToken", this.UserToken);
                    this.LoggedIn = true;
                    localStorage.setItem(
                        "Logged",
                        JSON.stringify(this.LoggedIn)
                    );
                    console.log(this.UserToken);
                });
            } catch (errors) {
                alert(errors)
                console.log(errors);
            }
        },
        async getPinnedCompanies(token: string) {
            try {
                await axios({
                    method: "get",
                    url: "/dashboards",
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                }).then((response) => {
                    if (response.data.data.companies.length >= 1) {
                        this.companies.data = response.data.data.companies;
                    }
                    console.log(this.companies);
                    console.log(response);
                });
            } catch (errors) {
                console.log(errors);
            }
        },
        async pinCompany(ico: number) {
            try {
                await axios({
                    url: "/dashboards/addCompany",
                    method: "patch",
                    headers: {
                        Authorization:
                            "Bearer" + localStorage.getItem("UserToken"),
                    },
                    params: {
                        company_ico: ico,
                    },
                }).then((response) => {
                    console.log(response);
                });
            } catch (errors) {
                alert(errors)
                console.log(errors);
            }
        },
        async unpinCompany(ico: number) {
            try {
                await axios({
                    url: "/dashboards/removeCompany",
                    method: "patch",
                    headers: {
                        Authorization:
                            "Bearer" + localStorage.getItem("UserToken"),
                    },
                    params: {
                        company_ico: ico,
                    },
                }).then((response) => {
                    console.log(response);
                });
            } catch (errors) {
                alert(errors)
                console.log(errors);
            }
        },
        async refreshToken(token: string) {
            try {
                await axios({
                    method: "post",
                    url: "/refresh",
                    headers: {
                        Authorization: "Bearer" + token,
                    },
                }).then((response) => {
                    this.UserToken = response.data.data.token;
                    this.UserData = response.data.data.user;
                    localStorage.setItem("Username", this.UserData.name);
                    localStorage.setItem("UserSurname", this.UserData.surname);
                    localStorage.setItem("E-mail", this.UserData.email);
                    localStorage.setItem("UserToken", this.UserToken);
                    this.LoggedIn = true;
                    localStorage.setItem(
                        "Logged",
                        JSON.stringify(this.LoggedIn)
                    );
                    console.log(this.UserToken);

                    console.log(response);
                });
            } catch (errors) {
                alert(errors)
                console.log(errors);
            }
        },
    },
});
