import AppStorage from "./AppStorage";
import Token from "./Token";

class User {
    
    login(formData){
        axios.post('/api/auth/login' , formData)
        .then(res => {
            let data = res.data;
            console.log(data);
            this.responseAfterLogin(data);
        })
        .catch(err => console.error(err.response.data));
    }

    responseAfterLogin(data){
        const token = data.access_token;
        const user = data.user;
        if(Token.isValid(token)){
            AppStorage.store(token , user);
        }
    }

    hasToken(){
        const storedToken = AppStorage.getToken();
        if(storedToken){
            return Token.isValid(storedToken);
        }

        return false;
    }

    loggedIn(){
        return this.hasToken();
    }

    logout(){
        AppStorage.clear();
        
    }

    name(){
        if(this.loggedIn()){
            return AppStorage.getUser();
        }
    }

    id(){
        if(this.loggedIn()){
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
    }
}

export default User = new User();