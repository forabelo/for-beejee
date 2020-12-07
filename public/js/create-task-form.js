let createTaskForm = new Vue({
    el: '#createTaskForm',
    data: {
        form: {
            name: '',
            email: '',
            description: ''
        },
        errors: []
    },
    methods: {
        submitForm() {
            axios.post('/create-task', {
                name: this.form.name,
                email: this.form.email,
                description: this.form.description
            }).then((response) => {
                alert(response.data.message)

                window.location.reload()
            }).catch((err) => {
                console.log(err.response.data.errors)
                this.errors = err.response.data.errors
            })
        }
    }
})
