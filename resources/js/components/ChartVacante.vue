<template>
  <div class="col-11 mt-4">
    <canvas id="myChart" width="200" height="150"></canvas>
  </div>
</template>



<script>
import Chart from 'chart.js/auto';
export default {
    props:['vistas', 'candidatos', 'likes', 'comentarios'],

    data(){
        return{
            now:new Date(Date.now()),
            monthAgo:new Date(Date.now()),
            ago25:new Date(Date.now()),
            ago20:new Date(Date.now()),
            ago15:new Date(Date.now()),
            ago10:new Date(Date.now()),
            ago5:new Date(Date.now()),
        }
    },

    mounted(){
        this.setLimitDates();
        const dataVistas = this.handleDataVistas();
        const dataCandidatos = this.handleDataCandidatos();
        const dataInteracciones = this.handleDataInteracciones(dataVistas);

        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['30-25 Days Ago', '25-20 Days Ago', '20-15 Days Ago', '15-10 Days Ago', '10-5 Days Ago', '5-now Days Ago'],
        datasets: [{
            label: 'Concurrencia(Vistas)',
            data: dataVistas,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2,
            tension:0.1,
        },
        {
            label: 'Candidatos',
            data: dataCandidatos,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2,
            tension:0.1,
        },

        {
            label: 'Interaccion',
            data: dataInteracciones,
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 2,
            tension:0.1,
        },

        
    ]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
myChart;
    },

    methods:{
        setLimitDates(){
            this.vistas.forEach(vis => {
                vis.created = new Date(vis.created)
            });
            this.candidatos.forEach(cand => {
                cand.created_at = new Date(cand.created_at)
            });
            this.likes.forEach(like => {
                like.created_at = new Date(like.created)
            });
            this.comentarios.forEach(comm => {
                comm.created_at = new Date(comm.created_at)
            });

            //month ago
            this.monthAgo.setDate(this.now.getDate() - 30)
            
            //25 days ago
            this.ago25.setDate(this.now.getDate() - 25)

            //20 days ago
            this.ago20.setDate(this.now.getDate() - 20)

            //15 days ago
            this.ago15.setDate(this.now.getDate() - 15)

            //10 days ago
            this.ago10.setDate(this.now.getDate() - 10)

            //5 days ago
            this.ago5.setDate(this.now.getDate() - 5)


        },
        handleDataVistas(){
            const filtrerInRange = this.vistas.filter(vis => vis.created >= this.monthAgo && vis.created <= this.now)

            // console.log(this.monthAgo,this.ago25,this.ago20, this.ago15, this.ago10, this.ago5)
            const data30_25days = filtrerInRange.filter(vis => vis.created >= this.monthAgo && vis.created <= this.ago25)
            const data25_20days = filtrerInRange.filter(vis => vis.created >= this.ago25 && vis.created <= this.ago20)
            const data20_15days = filtrerInRange.filter(vis => vis.created >= this.ago20 && vis.created <= this.ago15)
            const data15_10days = filtrerInRange.filter(vis => vis.created >= this.ago15 && vis.created <= this.ago10)
            const data10_5days = filtrerInRange.filter(vis => vis.created >= this.ago10 && vis.created <= this.ago5)
            const data5_now = filtrerInRange.filter(vis => vis.created >= this.ago5 && vis.created <= this.now)


            const vistasPro = [data30_25days.length, data25_20days.length, data20_15days.length, data15_10days.length,
                data10_5days.length, data5_now.length,
            ]

            return vistasPro;
        },

        handleDataCandidatos(){
            const filtrerInRange = this.candidatos.filter(vis => vis.created_at >= this.monthAgo && vis.created_at <= this.now)

            const data30_25days = filtrerInRange.filter(vis => vis.created_at >= this.monthAgo && vis.created_at <= this.ago25)
            const data25_20days = filtrerInRange.filter(vis => vis.created_at >= this.ago25 && vis.created_at <= this.ago20)
            const data20_15days = filtrerInRange.filter(vis => vis.created_at >= this.ago20 && vis.created_at <= this.ago15)
            const data15_10days = filtrerInRange.filter(vis => vis.created_at >= this.ago15 && vis.created_at <= this.ago10)
            const data10_5days = filtrerInRange.filter(vis => vis.created_at >= this.ago10 && vis.created_at <= this.ago5)
            const data5_now = filtrerInRange.filter(vis => vis.created_at >= this.ago5 && vis.created_at <= this.now)


            const candidatosPro = [data30_25days.length, data25_20days.length, data20_15days.length, data15_10days.length,
                data10_5days.length, data5_now.length,
            ]

            return candidatosPro;
        },

        handleDataInteracciones(dataVistas){
            const filtrerInRange = this.likes.filter(vis => vis.created_at >= this.monthAgo && vis.created_at <= this.now)

            const data30_25days = filtrerInRange.filter(vis => vis.created_at >= this.monthAgo && vis.created_at <= this.ago25)
            const data25_20days = filtrerInRange.filter(vis => vis.created_at >= this.ago25 && vis.created_at <= this.ago20)
            const data20_15days = filtrerInRange.filter(vis => vis.created_at >= this.ago20 && vis.created_at <= this.ago15)
            const data15_10days = filtrerInRange.filter(vis => vis.created_at >= this.ago15 && vis.created_at <= this.ago10)
            const data10_5days = filtrerInRange.filter(vis => vis.created_at >= this.ago10 && vis.created_at <= this.ago5)
            const data5_now = filtrerInRange.filter(vis => vis.created_at >= this.ago5 && vis.created_at <= this.now)


            const likesPro = [data30_25days.length, data25_20days.length, data20_15days.length, data15_10days.length,
                data10_5days.length, data5_now.length,
            ]

            const dataComments = this.handleDataComments();


            const likesDefe = likesPro.map(elem => elem * 0.5);
            const vistasDefe = dataVistas.map(elem => elem = elem * 0.2);
            const commsDefe = dataComments.map(elem => elem * 0.3)


            const total = []
            for(i = 0; i < likesDefe.length; i++){
                total[i] = likesDefe[i]+vistasDefe[i]+commsDefe[i];
            }

            return total;
        },


        handleDataComments(){
            const filtrerInRange = this.comentarios.filter(vis => vis.created_at >= this.monthAgo && vis.created_at <= this.now)

            const data30_25days = filtrerInRange.filter(vis => vis.created_at >= this.monthAgo && vis.created_at <= this.ago25)
            const data25_20days = filtrerInRange.filter(vis => vis.created_at >= this.ago25 && vis.created_at <= this.ago20)
            const data20_15days = filtrerInRange.filter(vis => vis.created_at >= this.ago20 && vis.created_at <= this.ago15)
            const data15_10days = filtrerInRange.filter(vis => vis.created_at >= this.ago15 && vis.created_at <= this.ago10)
            const data10_5days = filtrerInRange.filter(vis => vis.created_at >= this.ago10 && vis.created_at <= this.ago5)
            const data5_now = filtrerInRange.filter(vis => vis.created_at >= this.ago5 && vis.created_at <= this.now)


            const comentariosPro = [data30_25days.length, data25_20days.length, data20_15days.length, data15_10days.length,
                data10_5days.length, data5_now.length,
            ]

            return comentariosPro;
        },


    },
}
</script>



<style>

</style>