<template>
  <section>
    
    <h2>Monthly Statistics</h2>
    <p>Overview of counter values grouped by month of creation.</p>


    <Loading v-if="loading" />

    <div v-else>




      <div class="statistics">
      
          <bar-chart
            :chart-data="chartData"
            :options="chartOptions"
          />

      </div>

    </div>

    <v-btn color="default" @click="goto('module.statistics.index')">Tilbage</v-btn>

  </section>
</template>


<script>

import { Bar } from 'vue-chartjs'
import { mixins } from 'vue-chartjs'
import axios from 'axios'
import moment from 'moment'
import TableEdit from "@/Mixins/TableEdit";

// Register your chart components
export default {
  mixins: [TableEdit],
  
  name: 'BarChart',

  components: {
    'bar-chart': {
      extends: Bar,
      mixins: [mixins.reactiveProp],
      props: ['chartData', 'options'],
      mounted() {
        this.renderChart(this.chartData, this.options);
      }
    }
  },

  data() {
    return {
      loading: true,
      chartTitle: "",
      chartDescription: "",
      chartData: {
        labels: [], // Dynamically populated with month labels
        datasets: [{
          label: 'Antal',
          data: [], // Dynamically populated with counter values
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },

      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1, // Ensure that the axis increments by 1
            }
          }
        }
      }

    };
  },

  methods: {
    get() {


      return axios.get(route("api.statistics.index"),{
        params: {
          include: "items,categories,votes",
          lang: this.$i18n.locale
        }
      }).then((res) => {
          
          const statistics = res.data.data;
          this.processData(statistics);
          this.loading = false;

        });

    },


    processData(statistics) {

      const monthlyData = {};
      const currentYear = moment().year();
      
      // Initialize all 12 months of the current year to 0
      for (let i = 0; i < 12; i++) {
        const month = moment().month(i).year(currentYear).format('MMMM YYYY');
        monthlyData[month] = 0;
      }

      // Process statistics to only include data from the current year
      statistics.forEach(stat => {
        const statDate = moment(stat.created_at, "DD-MM-YYYY HH:mm");
        
        // Only process statistics from the current year
        if (statDate.year() === currentYear) {
          const month = statDate.format('MMMM YYYY');
          
          stat.votes.forEach(counter => {
            monthlyData[month] += counter.value;
          });
        }
      });

      // Extract months for the chart
      const monthsToShow = Object.keys(monthlyData);

      // Update chart data with all 12 months
      this.chartData.labels = monthsToShow;
      this.chartData.datasets[0].data = monthsToShow.map(month => monthlyData[month]);
    }

  },

 
}
</script>

<style scoped>
.statistics {
  height: auto;
  width: 100%;
  padding: 20px;
  background: #fff;
  margin-bottom: 20px;
}
</style>
