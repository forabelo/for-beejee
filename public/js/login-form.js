let loginForm = new Vue({
    el: '#loginForm',
    data: {
        form: {
            login: '',
            password: ''
        },
        errors: []
    },
    methods: {
        submitForm() {
            axios.post('/login', {
                login: this.form.login,
                password: this.form.password
            }).then((response) => {
                alert(response.data.message)
                window.location.replace('/')
            }).catch((err) => {
                this.errors = err.response.data.errors
            })
        }
    }
})
