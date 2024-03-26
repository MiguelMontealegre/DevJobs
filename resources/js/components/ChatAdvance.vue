<template>
    <div>
        <form @submit.prevent="sendMessage">
        <label>Chat</label>
        <input type="text" v-model="message">
        <button type="submit">Submit</button>
        </form>
        <button @click="getData">get</button>
    </div>
</template>

<script>
import {saveMessage , getData, saveSession} from '../firebase.js'
export default {
    props:['userId', 'user', 'destiny'],

    data(){
        return{
            data:[],
            message:'',
            flagNewSession:0,
        }
    },

    mounted(){
        console.log(this.user)
        console.log(this.destiny)
        this.getData();
    },

    methods:{
        sendMessage(){
            //CurrentDate
            const currentDate = Date.now();
            const today = new Date(currentDate);
            const formatted_today = today.getDate() + " " + today.getMonth() + " " + today.getFullYear();

            //Request
            const dato = {
                date:formatted_today,
                content:this.message,
                userId:this.user.id,
            }

            if (this.data.length === 0){
                this.flagNewSession = 1;
            }
            else{

            const auxData = this.data
            for(const i in auxData){
            if(auxData[i].remitent.id === this.user.id && auxData[i].destiny.id === this.destiny.id){
                    saveMessage(auxData[i].id,dato)
                }
            else{
                this.flagNewSession = 1;
            }
            }
            }
            
            if(this.flagNewSession === 1){
                const session = {
                    sessionId: new Date().toString(),
                    remitent: {
                        ...this.user
                    },
                    destiny: {
                        ...this.destiny
                    },
                    messages: [
                        dato
                    ]
                }
                saveSession(session.sessionId,session.remitent, session.destiny,session.messages);
                this.flagNewSession = 0
            }

            this.message = '';
        },

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
        }
    }
}
</script>

<style>

</style>