<template>
  <section>
    <Loading v-if="loading"/>

    <div v-else>
      <div class="content-header">
        <h1>Opret Statistik
          <small>Opret en statestik-punkt og tillæg det en kategori</small>  
        </h1>   
      </div>



      <form @submit.prevent="submit">
        <table class="table">
          <thead>
            <tr>
              <th colspan="2">Statistik</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td width="150">Overskrift</td>
              <td>

                <TextField 
                  name="title"
                  v-model="input.title"
                />

              </td>
            </tr>
            <tr>
              <td>Beskrivelse</td>
              <td>

                <TextArea
                  name="description"
                  v-model="input.description"
                />

              </td>
            </tr>
     
          </tbody>
        </table>



        <SelectCategories
          type = "statistics"
          v-model="input.categories"
          :checked="false"
        />



        <v-btn color="primary" type="submit" :loading="submitLoading">{{ submitText }}</v-btn>
        <v-btn color="default" @click="goto('module.statistics.index')">Tilbage</v-btn>


      </form>
    </div>
  </section>
</template>

<script>
import TableEdit from "@/Mixins/TableEdit";

export default {
  mixins: [TableEdit],

  data() {
    return {
      table: "statistics",
      input: {
        title: "",
        description: "",
        categories:[],
        amount: 0,
        items: [{
          value: ""
        }]  // Sørg for at counters er initialisert som en tom array               
      },
    };
  },

  methods: {
    async create() {
      let input = this.input;

      return axios.post(route("api.statistics.statistics.store"), input).then((res) => {
        this.$router.push({ name: "module.statistics.index" });
      });
    },

    async update() {
      let input = this.input;

      return axios.patch(route("api.statistics.statistics.update", { id: this.id }), input).then((res) => {
        this.$router.push({ name: 'module.statistics.index' });
      });
    },

    addCounterRow() {

      // Sjekk og initialiser input.counters hvis det er undefined eller null
      if (!this.input.items) {

        this.input.items = [];

      }

      this.input.items.push({ name: { "en ": ""} });
    },

    get(params) {
      return axios.get(route("api.statistics.statistics.show", params), { 
        params: { 
          include: "categories,votes"
        }
      }).then((res) => {
        
        let data  = res.data.data

        this.input = data;

      });
    }
  }
};
</script>

<style scoped>
/* Add your styles here if needed */
</style>
