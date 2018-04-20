import * as API from './'


export default{
    login:params =>{
        return API.POST('/api/v1/users/login',params)
},
    logout:params => {
        return API.GET('/api/v1/users/logout',params)
},
    changeProfile:params => {
        return API.PATCH('/api/v1/users/profile',params)
},
    findList:params =>{
        return API.GET('/api/v1/users/',params)
},
}