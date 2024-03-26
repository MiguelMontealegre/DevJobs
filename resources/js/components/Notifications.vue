<template>
<div>
        <!--Importar libreria element ui-->
        <el-dropdown trigger="click">
            <i
                class="el-dropdown-link el-icon-message-solid"
                style="font-size: 26px;"
            />
				<span class="notification-pro">     <!--count notifications-->
					{{counter}}
				</span>     
            <el-dropdown-menu slot="dropdown">
                <div class="handle-overflow scrollNotifications">
				<p class="title-top">Notifications</p>
				<hr class="hr1">
                <div v-for="(notification, index) in definitiveNotifications" :key="index">
					<div class="container-notification">
                        <center>
                            <p class="notification-date">{{notification.date}}</p>
                        </center>
                        
                        <el-dropdown-item v-for="(subnotification, index) in notification.Belongnotifications" :key="index">
                        <img src="/material/img/version4.png" alt="vacante" class="rounded-circle img-notification">  <!-- src="/{subnotification.imagen}" -->
						<aside>
							<p style="font-weight:bold;">{{subnotification.title}} <span>{{subnotification.user}}</span></p>
							<br>
							<p>{{subnotification.content}} <span class="content-notification">{{subnotification.user}}</span>!</p>
						</aside>
						<hr class="hr2">
                        </el-dropdown-item>
					</div>
				</div>
			<p class="wrap-footer"> <a href="#" class="link-footer">See All Notifications</a> </p>
            </div>
            </el-dropdown-menu>
        </el-dropdown>
</div>
</template>

<script>
import {Dropdown, DropdownMenu, DropdownItem } from 'element-ui';
export default {
    components:{
        ElDropdown:Dropdown,
        ElDropdownMenu:DropdownMenu,
        ElDropdownItem:DropdownItem
    },

    data(){
        return{
            defaultNotifications:[
				{
					date:'2022-08-18 02:25:36',
					title:'New profile data for',
					user:'Jhon Smith',
					content:'Check out the updated profile for'
				},
				{
					date:'2022-08-18 02:25:36',
					title:'New profile data for',
					user:'Sara Amaya',
					content:'Check out the updated profile for '
				},
				{
					date:'2022-08-18 02:25:36',
					title:'New profile data for',
					user:'Lucas musk',
					content:'Check out the updated profile for'
				},
                {
					date:'2022-08-17 02:25:36',
					title:'New profile data for',
					user:'Lucas musk',
					content:'Check out the updated profile for'
				},
                {
					date:'2022-08-17 02:25:36',
					title:'New profile data for',
					user:'Lucas musk',
					content:'Check out the updated profile for'
				},
                {
					date:'2022-08-16 02:25:36',
					title:'New profile data for',
					user:'Lucas musk',
					content:'Check out the updated profile for'
				},
                {
					date:'2022-08-03 02:25:36',
					title:'New profile data for',
					user:'Lucas musk',
					content:'Check out the updated profile for'
				},
			],

            definitiveNotifications:[]
        }
    },

    mounted(){
        this.handleData();
    },

    methods:{
        handleData(){
            //Formatear fechas
            const months = ["JANUARY", "FEBRUARY", "MARCH","APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];
            for(const i in this.defaultNotifications){
                var date = new Date(this.defaultNotifications[i].date)
                let formatted_date = date.getDate() + " " + months[date.getMonth()] + " " + date.getFullYear()
                this.defaultNotifications[i].date = formatted_date;
            }
            

            //Clasificar por fechas
            const data = this.defaultNotifications;
            for(const i in data){
                const notifications = this.defaultNotifications.filter(noti => noti.date === data[i].date)

                const aux = {
                date:data[i].date,
                Belongnotifications: notifications
                }
                this.definitiveNotifications.push(aux)
            }

            //Eliminar duplicados
            let set = new Set( this.definitiveNotifications.map( JSON.stringify ) )
            let arrSinDuplicaciones = Array.from( set ).map( JSON.parse );
            this.definitiveNotifications = arrSinDuplicaciones;


            // console.log(this.definitiveNotifications.sort((a, b) => new Date(b.date) - new Date(a.date)));

            //HOY
            const timeElapsed = Date.now();
            const today = new Date(timeElapsed);
            const formatted_today = today.getDate() + " " + months[today.getMonth()] + " " + today.getFullYear();

            //AYER
            const timeElapsed2 = Date.now();
            const today2 = new Date(timeElapsed2);
            today2.setDate(today2.getDate() - 1)
            const formatted_yesterday = today2.getDate() + " " + months[today2.getMonth()] + " " + today2.getFullYear();

            //3 DAYS AGO
            const timeElapsed3 = Date.now();
            const today3 = new Date(timeElapsed3);
            today3.setDate(today3.getDate() - 2)
            const formatted_3dAgo = today3.getDate() + " " + months[today3.getMonth()] + " " + today3.getFullYear();


            for(const i in this.definitiveNotifications){
                if(this.definitiveNotifications[i].date === formatted_today){
                    this.definitiveNotifications[i].date = "Today"
                }
                else if(this.definitiveNotifications[i].date === formatted_yesterday){
                     this.definitiveNotifications[i].date = "Yesterday"
                }
                else if(this.definitiveNotifications[i].date === formatted_3dAgo){
                     this.definitiveNotifications[i].date = "3 Days Ago"
                }
            }

        }
    },

    computed:{
        counter(){
            return this.defaultNotifications.length
        }
    }

}
</script>


<style>
    .notification-pro {
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 4px;
    padding-bottom: 4px;
	margin-left: 0.1rem;
	border-radius: 10%;
	background-color: rgb(16, 240, 173);
	color:#FFF;
	font-weight: bold;
    font-size: 1rem;
	}


    .notification-date{
        margin-left:auto;
        margin-right:auto;
    }

    .hr1{
        width: 94%;
        border-color:rgb(95, 84, 84);
        margin-left: 3%; 
        height: 3px;
    }

    .hr2{
        width: 96%;
        border-color:rgb(223, 223, 223);
        margin-left: 2%;
    }

    .title-top{
        margin-left:35px;
        margin-top:15px;
    }


    .container-notification{
        width:425px;
    }

    .img-notification{
        float: right;
        margin-left: 15px;
        height: 57px;
         width:59px;
    }

    .content-notification{
        color:rgb(16, 240, 173);
        font-weight:430;
        text-decoration: underline;
    }

    .link-footer{
        margin-left:35px;
        color:rgb(16, 240, 173);
        font-weight:460;
    }

    .wrap-footer{
        margin-top:42px;
    }

    .handle-overflow{
        overflow: auto;
        max-height: 450px;
    }

    /* SCROLL ----------------------------*/
    .scrollNotifications::-webkit-scrollbar {
    -webkit-appearance: none;
    }

    .scrollNotifications::-webkit-scrollbar:vertical {
    width:9px;
    }

    .scrollNotifications::-webkit-scrollbar-button:increment,.scrollNotifications::-webkit-scrollbar-button {
    display: none;
    } 

    .scrollNotifications::-webkit-scrollbar:horizontal {
    height: 7px;
    }

    .scrollNotifications::-webkit-scrollbar-thumb {
    background-color: #00000081;
    border-radius: 20px;
    border: 2px solid #f5fac7;
    }

    .scrollNotifications::-webkit-scrollbar-track {
    border-radius: 10px;  
    }


</style>