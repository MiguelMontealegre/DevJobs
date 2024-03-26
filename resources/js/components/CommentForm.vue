<template>
    <div class="col-8 mx-auto">
    <form @submit.prevent="submit">
          <!-- <label for="comentario">Deja tu comentario, Sapo perro</label>
          <input id="comentario" type="text" v-model="comment"> -->

        <editor ref="toastuiEditor" v-model="comment" :initialValue="comment" height="312px" previewStyle="tab" :options="editorOptions"></editor>
        <button class="mx-auto btneon btneon--2 font-bold mt-5">Submit</button>
    </form>
    </div>
</template>





<script>
import { Editor } from '@toast-ui/vue-editor'
import '@toast-ui/editor/dist/toastui-editor.css'
import '@toast-ui/editor/dist/toastui-editor-viewer.css'
import '@toast-ui/editor/dist/toastui-editor-only.css'

export default {
    components:{
        Editor
    },

    props:{
        userId:{
        type:Number,
        required:false
        },
        vacanteId:{
        type:Number,
        required:true   
        },
    },

    data(){
        return{
            comment:null,

            editorOptions:{
                minHeight: '200px',
                language: 'en-US',
                useCommandShortcut: true,
                usageStatistics: false,
                hideModeSwitch: false,
                placeholder: 'Deja tu comentario ...',
                toolbarItems: [
                    ['heading', 'bold', 'italic', 'strike'],
                    ['hr', 'quote'],
                    ['ul', 'ol', 'task', 'indent', 'outdent'],
                    ['table', 'link'],
                    ['code', 'codeblock'],
                    ['scrollSync'],
                ]
            }
        }
    },



    methods:{
        getHTML() {
        let html = this.$refs.toastuiEditor.invoke('getHTML');
        this.comment = html;
      },
         submit(){
            this.getHTML();
                const loading = this.$loading({
                lock: true,
                text: 'Loading',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
                });

            const url = '/comentarios2/store';
            const comment = {
                content: this.comment,
                userId:this.userId,
                vacanteId:this.vacanteId,
                comentario_id:null
            }
            axios.post(url, comment)
            .then(respuesta => {
                console.log(respuesta) 
                this.comment = null;
                loading.close();
            })
            .catch(error => {
                        if(error.response.status === 401) {   
                            window.location = '/register';   
                        }
            });

            this.$emit('actualizar');
        }
    }
}

</script>


<style>

</style>