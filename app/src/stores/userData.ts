import { ref, computed } from "vue";
import { defineStore } from "pinia";
import axios from "axios";

export const useUserInfo = defineStore('UserInfo', {
    state: () => {
        return {
            UserToken: "",
            UserData: [],
            LoggedIn: false,
            companies: {data: []},
        }
    },
    actions: {
        async login(pass: string, mail: string) {
            try {
                axios({
                    url: "/auth/login",
                    method: "post",
                    data: {
                        login: mail,
                        password: pass,
                    }
                }).then((response) => {
                    console.log(response)
                    this.UserToken = response.data.data.token
                    this.UserData = response.data.data.user
                    localStorage.setItem("Username" ,this.UserData.name)
                    localStorage.setItem("UserSurname" ,this.UserData.surname)
                    localStorage.setItem("E-mail", this.UserData.email)
                    localStorage.setItem("UserToken" , this.UserToken)
                    this.LoggedIn = true
                    localStorage.setItem("Logged", JSON.stringify(this.LoggedIn))
                    console.log(this.UserToken)
                })
            } catch (errors) {
                console.log(errors)
            }
        },
        register(name: string, surname: string, email: string, password: string, password_confirm: string) {
            try {
                axios({
                    method: "post",
                    url: "/auth/signup",
                    data: {
                        name: name,
                        surname: surname,
                        email: email,
                        password: password,
                        password_confirm: password_confirm
                    }
                }).then((response) => {
                    console.log(response)
                    this.UserToken = response.data.data.token
                    this.UserData = response.data.data.user
                    localStorage.setItem("Username" ,this.UserData.name)
                    localStorage.setItem("UserSurname" ,this.UserData.surname)
                    localStorage.setItem("E-mail", this.UserData.email)
                    localStorage.setItem("UserToken" , this.UserToken)
                    this.LoggedIn = true
                    localStorage.setItem("Logged", JSON.stringify(this.LoggedIn))
                    console.log(this.UserToken)
                })
            } catch (errors) {
                console.log(errors)
            }
        },
        async getPinnedCompanies(token: string) {
            try {
                axios({
                    method: "get",
                    url: "/dashboards",
                    headers: {
                        Authorization: 'Bearer' + token
                    }
                }).then((response) => {
                    if (response.data.data.companies.length >= 1) {
                        this.companies.data = response.data.data.companies
                    }
                    console.log(this.companies)
                    console.log(response)
                })
            } catch (errors) {
                console.log(errors)
            }
        },
        async pinCompany(ico: number) {
            try {
                axios({
                    url: "/dashboards/addCompany",
                    method: "patch",
                    headers: {
                        Authorization: 'Bearer' + localStorage.getItem("UserToken")
                    },
                    params: {
                        company_ico: ico
                    }
                }).then((response) => {
                    console.log(response)
                })
            } catch (errors) {
                console.log(errors)
            }
        }
    }
})
