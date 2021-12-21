<template>

    


</template>

<script>
    export default {
        name: "MessageComponent",
        data(){

            return {

                users: []
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{

            fetchMessages() {
                axios.get('messages').then(response => {
                    console.log( response.data );
                    this.messages = response.data;
                })
            },
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('messages', {message: this.newMessage});
                this.newMessage = '';
            },
        }
    }
</script>
