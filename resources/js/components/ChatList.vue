<template>
  <div class="wrapper">
    <p>{{listChat}}</p>
            <p>{{messagesPro}}</p>

    <div class="container">
        <div class="left">
            <div class="top">
                <input type="text" placeholder="Search" />
                <a href="javascript:;" class="search"></a>
            </div>
            <ul class="people">
                <li class="person" v-for="(dat,index) in listChat" :key="index" data-chat="person1">
                    <div @click="handleMessagesList(dat.sessionId)">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/thomas.jpg" alt="" />
                        <span class="name">{{dat.name.name}}</span>
                        <span class="time">{{dat.messages[dat.messages.length - 1].date}}</span>  <!--{{dat.messages[messages.length - 1].date}}-->
                        <span class="preview">test</span>
                    </div>
                </li>
                <!-- <li class="person" data-chat="person2">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/dog.png" alt="" />
                    <span class="name">Dog Woofson</span>
                    <span class="time">1:44 PM</span>
                    <span class="preview">I've forgotten how it felt before</span>
                </li>
                <li class="person" data-chat="person3">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/louis-ck.jpeg" alt="" />
                    <span class="name">Louis CK</span>
                    <span class="time">2:09 PM</span>
                    <span class="preview">But we’re probably gonna need a new carpet.</span>
                </li>
                <li class="person" data-chat="person4">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/bo-jackson.jpg" alt="" />
                    <span class="name">Bo Jackson</span>
                    <span class="time">2:09 PM</span>
                    <span class="preview">It’s not that bad...</span>
                </li>
                <li class="person" data-chat="person5">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/michael-jordan.jpg" alt="" />
                    <span class="name">Michael Jordan</span>
                    <span class="time">2:09 PM</span>
                    <span class="preview">Wasup for the third time like is you blind bitch</span>
                </li>
                <li class="person" data-chat="person6">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/382994/drake.jpg" alt="" />
                    <span class="name">Drake</span>
                    <span class="time">2:09 PM</span>
                    <span class="preview">howdoyoudoaspace</span>
                </li> -->
            </ul>
        </div>
        <div class="right">
            <div class="top"><span>To: <span class="name">Dog Woofson</span></span></div>
            <div class="chat">
                <div class="conversation-start">
                    <span>Today, 6:48 AM</span>
                </div>
                <div v-for="(mes,index) in messagesPro" :key="index" :class="['bubble', mes.userId === userId ? 'you' : 'me']">
                    {{mes.content}}
                </div>
            </div>
            <!-- <div class="chat" data-chat="person2">
                <div class="conversation-start">
                    <span>Today, 5:38 PM</span>
                </div>
                <div class="bubble you">
                    Hello, can you hear me?
                </div>
                <div class="bubble you">
                    I'm in California dreaming
                </div>
            </div>
            <div class="chat" data-chat="person3">
                <div class="conversation-start">
                    <span>Today, 3:38 AM</span>
                </div>
                <div class="bubble you">
                    Hey human!
                </div>
                <div class="bubble you">
                    Umm... Someone took a shit in the hallway.
                </div>
            </div>
            <div class="chat" data-chat="person4">
                <div class="conversation-start">
                    <span>Yesterday, 4:20 PM</span>
                </div>
                <div class="bubble me">
                    Hey human!
                </div>
            </div>
            <div class="chat" data-chat="person5">
                <div class="conversation-start">
                    <span>Today, 6:28 AM</span>
                </div>
                <div class="bubble you">
                    Wasup
                </div>
            </div>
            <div class="chat" data-chat="person6">
                <div class="conversation-start">
                    <span>Monday, 1:27 PM</span>
                </div>
                <div class="bubble you">
                    So, how's your new phone?
                </div>
            </div> -->
            <div class="write">
                <a href="javascript:;" class="write-link attach"></a>
                <input type="text" />
                <a href="javascript:;" class="write-link smiley"></a>
                <a href="javascript:;" class="write-link send"></a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {saveMessage , getData, saveSession} from '../firebase.js'
export default {
    props:['userId', 'user'],

    data(){
        return{
            data:[],
            messages:[],
        }
    },

    mounted(){
        this.getData();
    },

    computed:{
        listChat(){
            const dataFil = this.data.filter(dat => dat.destiny.id === this.userId || dat.remitent.id === this.userId)
            return this.filterNamesList(dataFil)
        },
        messagesPro(){
            return this.messages
        }
    },

    methods:{
        async getData(){
            const querySnapshot = await getData();

            querySnapshot.forEach(snap => {
                const aux = {
                    id: snap.id,
                    remitent: snap.data().remitent,
                    destiny: snap.data().destiny,
                    messages: snap.data().messages,
                }
                this.data.push(aux);
            })
            console.log(this.data)
        },

        filterNamesList(dataFil){
            const list = [];
            dataFil.forEach(dat => {
                if(dat.destiny.id === this.userId){
                    list.push({name:dat.remitent, messages:dat.messages, sessionId:dat.id})
                }
                else if(dat.remitent.id === this.userId){
                    list.push({name:dat.destiny, messages:dat.messages, sessionId:dat.id})
                }
            })
            return list;
        },

        handleMessagesList(id){
            console.log(id)
            const aux = this.data.filter(dat => dat.id === id);
            this.messages = aux[0].messages;
        }
    }

}
</script>

<style>

</style>