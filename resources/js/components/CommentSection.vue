<template>
<div class="mt-10">

		<!-- <notifications/> -->

    <!-- <h2 class="font-bold text-gray-800 mt-8">Comentarios</h2>
    <div v-for="(data, index) in dataPro" :key="index" class="py-8 px-8 max-w-sm bg-white rounded-xl shadow-lg space-y-2 mb-7 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6 overflow-auto" style="max-height: 400px">
        <img class="block mx-auto rounded-circle sm:mx-0 sm:shrink-0" :src="imagen(data.img)" style="height: 60px; width:67px;">
        <div class="text-center space-y-2 sm:text-left overflow-auto" style="max-height: 200px">
            <div class="space-y-0.5">
            <p class="text-sm text-black font-semibold">
                <a class="text-black" :href="'/perfiles/' + data.userid">{{data.name}}</a>   &nbsp;&nbsp; <span class="text-green-500">@{{data.username}}</span>
            </p><br>
            <p class="text-slate-500 text-sm font-medium">
                {{data.created_at}}
            </p>

            <like-comment :like-comm="data.likeCom" :likes-comm="data.likesCom" :comment-id="data.commentId"/>

            </div>
            <p class="text-gray-700 px-4 py-1 text-sm font-semibold" v-html="data.content"></p>
        </div>
    </div> -->


<div class="comments-container">
		<h1>Comentarios</h1>

		<ul id="comments-list" class="comments-list" v-if="loading !== true">
			<li v-for="(data, index) in dataPro" :key="index">
				<div class="comment-main-level">
					<!-- Avatar -->
					<div class="comment-avatar"> <img :src="imagen(data.main.img)">  </div>
					<!-- Contenedor del Comentario -->
					<div class="comment-box">
						<div class="comment-head">
							<h6 class="comment-name by-author"><a class="text-black" :href="'/perfiles/' + data.main.userid">{{data.main.name}}</a></h6>
                            <span>{{data.main.created_at}}</span>
                            <i v-if="userId === data.main.userid" @click="deleteComment(data.main.commentId)" class="material-icons">delete</i>
							<i @click="reply(data.main.commentId, data.main.name)" class="fa fa-reply"></i>
							<like-comment :like-comm="data.main.likeCom" :likes-comm="data.main.likesCom" :comment-id="data.main.commentId"/>

						</div>
						<div class="comment-content scrollComment overflow-auto" style="max-height: 250px" v-html="data.main.content">
                            <!--Content-->
						</div>
					</div>
				</div>
				<!-- Respuestas de los comentarios -->
				<ul class="comments-list reply-list">
					<li v-for="(replies, index) in data.replies" :key="index">
						<div class="comment-avatar"><img :src="imagen(replies.img)">></div>
						<div class="comment-box">
							<div class="comment-head">
								<h6 class="comment-name"><a class="text-black" :href="'/perfiles/' + replies.userid">{{replies.name}}</a></h6>
								<span>{{replies.created_at}}</span>
                            	<i v-if="userId === replies.userid" @click="deleteComment(replies.commentId)" class="material-icons">delete</i>
								<i @click="reply(replies.reply_id, replies.name)" class="fa fa-reply"></i>
								<like-comment :like-comm="replies.likeCom" :likes-comm="replies.likesCom" :comment-id="replies.commentId"/>
							</div>
								<div class="comment-content" >
									<p class="text-green-500 font-bold">@{{replies.reply_name}}  </p> <p v-html="replies.content"></p>
								</div>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</div>

     <br><br>


    <comment-form
        :user-id="userId"
        :vacante-id="vacanteId"
        @actualizar="fetch"
		v-if="replyData.active !== true"
    ></comment-form>


	<comment-formreply
    @actualizar="fetch"
	@cancel="handleCancel"
	:user-id="userId"
    :vacante-id="vacanteId"
	:active="replyData.active"
	:id="replyData.commentId"
	:name-rep="replyData.nameRep"
	v-if="replyData.active === true">
	</comment-formreply>

</div>
</template>

<script>
import Notifications from './Notifications.vue'
import CommentForm from './CommentForm.vue'
import CommentFormreply from './CommentFormReply.vue'
import LikeComment from './LikeComment.vue'
export default {
    components:{
        CommentForm,
        LikeComment,
		CommentFormreply,
		Notifications
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
            data:null,
			replyData:{
				active:false,
				commentId:null,
				nameRep:null,
			},
			mainComments:null,
			replyComments:null,
			eachComm:[],

			loading:false,

        }
    },

    mounted(){
        this.fetch();
    },

    methods:{
        fetch(){
			this.loading = true;
			const loading = this.$loading({
                lock: true,
                text: 'Loading',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
                });
			this.data = null
			this.mainComments = null
			this.replyComments = null
			this.eachComm = []

            axios({
                method:'get',
                url: '/comentarios',
                params:{id: this.vacanteId}
            })
            .then(respuesta => {
			 	this.data = respuesta.data
				this.mainComments = this.data.filter(comm => comm.reply_id === null)
				this.replyComments = this.data.filter(comm => comm.reply_id !== null)

				const comms = this.mainComments
				for(const i in comms){
					const reps = this.replyComments.filter(comm => comm.reply_id === comms[i].commentId)
					const aux = {
						main: comms[i],
						replies:reps
					}
					this.eachComm.push(aux)
				}
					// console.log(this.eachComm)
					this.loading = false;
					loading.close();
			});

        },



        imagen(img){
            if(img === null){
                return '/material/img/version4.png';
            }
            else{
                return `/storage/perfiles/${img }`;
            }
        },


        deleteComment(id){
            this.$swal.fire({
                title: '¿Deseas eliminar este comentario?',
                text: "Una vez eliminado no se puede recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si',
                cancelButtonText:'No'
                }).then((result) => {
                    if (result.value) {

                        const url = `/comentariosEli/${id}`;
                        const params = {
                            _method: 'delete',
                        };
                        axios.post(url, params)
                        .then(response => {
                            this.$swal.fire(
                                    'Comentario Eliminado',
                                    response.data.mensaje,
                                    'success'
                                );

                            this.fetch();
                        })
                        .catch(error => {
                                console.log(error);
                            })
                    }
                })
        },


		reply(id, name){
			this.replyData.active = true;
			this.replyData.commentId = id;
			this.replyData.nameRep = name;
		},

		handleCancel(){
			this.replyData.active = false;
		}

    },



    computed:{
        dataPro(){
            return this.eachComm;
        },
    }
}
</script>

<style scope>
* {
 	margin: 0;
 	padding: 0;
 	-webkit-box-sizing: border-box;
 	-moz-box-sizing: border-box;
 	box-sizing: border-box;
 }

 a {
 	color: #03658c;
 	text-decoration: none;
 }


/** ====================
 * Lista de Comentarios
 =======================*/
 .notification {
	display: flex;
	align-items: center;
	justify-content: center;
	width: 1.3rem;
	height: 1.3rem;
	margin-left: 0.3rem;
	border-radius: 10%;
	background-color: rgb(16, 240, 173);
	color:#FFF;
	font-weight: bold;
	}

.comments-container {
	margin: 60px auto 15px;
	width: 768px;
}

.comments-container h1 {
	font-size: 36px;
	color: #283035;
	font-weight: 400;
}

.comments-container h1 a {
	font-size: 18px;
	font-weight: 700;
}

.comments-list {
	margin-top: 30px;
	position: relative;
}

/**
 * Lineas / Detalles
 -----------------------*/
.comments-list:before {
	content: '';
	width: 2px;
	height: 100%;
	background: #c7cacb;
	position: absolute;
	left: 32px;
	top: 0;
}

.comments-list:after {
	content: '';
	position: absolute;
	background: #c7cacb;
	bottom: 0;
	left: 27px;
	width: 7px;
	height: 7px;
	border: 3px solid #dee1e3;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
}

.reply-list:before, .reply-list:after {display: none;}
.reply-list li:before {
	content: '';
	width: 60px;
	height: 2px;
	background: #c7cacb;
	position: absolute;
	top: 25px;
	left: -55px;
}


.comments-list li {
	margin-bottom: 15px;
	display: block;
	position: relative;
}

.comments-list li:after {
	content: '';
	display: block;
	clear: both;
	height: 0;
	width: 0;
}

.reply-list {
	padding-left: 88px;
	clear: both;
	margin-top: 15px;
}
/**
 * Avatar
 ---------------------------*/
.comments-list .comment-avatar {
	width: 65px;
	height: 65px;
	position: relative;
	z-index: 99;
	float: left;
	border: 3px solid #FFF;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border-radius: 4px;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	overflow: hidden;
}

.comments-list .comment-avatar img {
	width: 100%;
	height: 100%;
}

.reply-list .comment-avatar {
	width: 50px;
	height: 50px;
}

.comment-main-level:after {
	content: '';
	width: 0;
	height: 0;
	display: block;
	clear: both;
}
/**
 * Caja del Comentario
 ---------------------------*/
.comments-list .comment-box {
	width: 680px;
	float: right;
	position: relative;
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
	-moz-box-shadow: 0 1px 1px rgba(0,0,0,0.15);
	box-shadow: 0 1px 1px rgba(0,0,0,0.15);
}

.comments-list .comment-box:before, .comments-list .comment-box:after {
	content: '';
	height: 0;
	width: 0;
	position: absolute;
	display: block;
	border-width: 10px 12px 10px 0;
	border-style: solid;
	border-color: transparent #FCFCFC;
	top: 8px;
	left: -11px;
}

.comments-list .comment-box:before {
	border-width: 11px 13px 11px 0;
	border-color: transparent rgba(0,0,0,0.05);
	left: -12px;
}

.reply-list .comment-box {
	width: 610px;
}
.comment-box .comment-head {
	background: #FCFCFC;
	padding: 10px 12px;
	border-bottom: 1px solid #E5E5E5;
	overflow: hidden;
	-webkit-border-radius: 4px 4px 0 0;
	-moz-border-radius: 4px 4px 0 0;
	border-radius: 4px 4px 0 0;
}

.comment-box .comment-head i {
	float: right;
	margin-left: 14px;
	position: relative;
	top: 2px;
	color: #A6A6A6;
	cursor: pointer;
	-webkit-transition: color 0.3s ease;
	-o-transition: color 0.3s ease;
	transition: color 0.3s ease;
}

.comment-box .comment-head i:hover {
	color: #03658c;
}

.comment-box .comment-name {
	color: #283035;
	font-size: 14px;
	font-weight: 700;
	float: left;
	margin-right: 10px;
}

.comment-box .comment-name a {
	color: #283035;
}

.comment-box .comment-head span {
	float: left;
	/* color: #999; */
	font-size: 13px;
	position: relative;
	top: 1px;
}

.comment-box .comment-content {
	background: #FFF;
	padding: 12px;
	font-size: 15px;
	color: #595959;
	-webkit-border-radius: 0 0 4px 4px;
	-moz-border-radius: 0 0 4px 4px;
	border-radius: 0 0 4px 4px;
}

.comment-box .comment-name.by-author, .comment-box .comment-name.by-author a {color: #03658c;}
.comment-box .comment-name.by-author:after {
	content: 'autor';
	background: #16cf25;
	color: #FFF;
	font-size: 12px;
	padding: 3px 5px;
	font-weight: 700;
	margin-left: 10px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}

/** =====================
 * Responsive
 ========================*/
@media only screen and (max-width: 766px) {
	.comments-container {
		width: 480px;
	}

	.comments-list .comment-box {
		width: 390px;
	}

	.reply-list .comment-box {
		width: 320px;
	}
}
</style>
