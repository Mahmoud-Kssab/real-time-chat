<template>
    <div class="container">
<h3 class=" text-center">Messaging</h3>
<div class="messaging">
      <div class="inbox_msg">
        <div class="inbox_people">
          <div class="headind_srch">
            <div class="recent_heading">
              <h4>Recent</h4>
            </div>
            <div class="srch_bar">
              <div class="stylish-input-group">
                <input type="text" class="search-bar"  placeholder="Search" >
                <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span> </div>
            </div>
          </div>
          <div class="inbox_chat">
            <div class="chat_list" v-for=" (user, index) in users" :key="index">
              <div class="chat_people">
                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                <div class="chat_ib">
                  <h5> <a href="#" @click="getMessages(user.id)"> {{ user.name }} </a> <span class="chat_date">Dec 25</span></h5>
                  <p>last message</p>
                </div>
              </div>
            </div>

          </div>
        </div>



        <div class="mesgs">
            <div class="msg_history">
                <div v-for="(message, index) in messages" :key="index">

                     <div v-if="message.if_sender === true" class="outgoing_msg">
                        <div class="sent_msg">
                        <p>{{message.body}}</p>
                        <span class="time_date"> 11:01 AM    |    June 9</span> </div>
                    </div>

                    <div v-else class="incoming_msg" >
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                        <div class="received_msg">
                        <div class="received_withd_msg">
                            <p>{{message.body}}</p>
                            <span class="time_date"> {{ message.sender_name }}    |    June 9</span></div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="type_msg">
                <div class="input_msg_write">
                    <input type="text" class="write_msg" placeholder="Type a message" @keyup.enter="sendMessage" v-model="newMessage" />
                    <!-- <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button> -->
                </div>
            </div>
        </div>


      </div>


      <p class="text-center top_spac"> Design by <a target="_blank" href="https://www.linkedin.com/in/sunil-rajput-nattho-singh/">Sunil Rajput</a></p>

    </div></div>
</template>

<script>
import message from './MessageComponent.vue'

    export default {
        name: "ChatsComponent",
        data(){

            return {
                users: [],
                messages: [],
                newMessage: '',
                receiver_id: null
            }
        },
        components :{
            message
        },
        mounted() {
             this.getUsers();
             this.getPublicMessages();


        },
        created() {


        },

        methods: {

            getUsers(){

                axios.get('/users')
                .then( res =>
                {
                    console.log(res.data);
                    this.users = res.data
                })
                .then( err => console.log( err ) )
            },getMessages($id){

                this.receiver_id = $id;

                axios.get('/messages/'+$id)
                .then( res =>
                {
                    this.messages = res.data
                })
                .then( err => console.log( err ) )
            },
            getPublicMessages(){

                axios.get('/public_messages')
                .then( res =>
                {
                    this.messages = res.data
                    window.Echo.join('chat')
                    .listen('MessageSent',(event) => {
                        console.log(event);
                        this.messages.push(event.message);
                })
                })
                .then( err => console.log( err ) )
            },
            sendMessage() {
                this.messages.push({
                    if_sender: true,
                    body: this.newMessage
                });
                axios.post('messages', {body: this.newMessage, receiver_id: this.receiver_id });
                this.newMessage = '';
            },
        }
    }
</script>
