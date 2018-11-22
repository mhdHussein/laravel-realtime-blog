class Token {

    isValid(token){
        const payload = this.payload(token);
        const loginIss = "http://localhost:8000/api/auth/login";
        const registerIss = "http://localhost:8000/api/auth/register";
        if(payload){
            return payload.iss === loginIss || registerIss;
        }

        return false;
    }

    payload(token){
        const payload = token.split('.')[1];
        return this.decode(payload);
    }

    decode(payload){
        return JSON.parse(atob(payload));
    }

}

export default Token = new Token();