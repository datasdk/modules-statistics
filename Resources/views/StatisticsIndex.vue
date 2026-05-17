<template>
  <section>


    <div class="content-header">

      <h1>
        Statestik
        <small>Her er en oversigt over alle dine statestikker </small>
      </h1>
      
      <v-btn color="primary" @click="goto('module.statistics.create')">Opret Statestik</v-btn>  

    </div>

      <v-card>
       


          <Table
            :headers="headers"   
            :route="route" 
            :table="table"
            :include="include"
            :move="move"
            :show="false"
    
          >

          <template v-slot:item.content="{ item }">
          <div>
      
          </div>
          </template>

            <template v-slot:item.user_id="{ item }">
              <div v-if="item.user">
                
                {{ item.user.first_name }} {{ item.user.last_name  }}

              </div>
            </template>


          </Table>

      </v-card>




  </section>
</template>


<script>

import TableIndex from "@/Mixins/TableIndex";


export default {

  mixins: [TableIndex],

  data(){

    return {

      table: "statistics",
      route: 'statistics.statistics',

      headers: [
          { text: 'Title', value: 'title' },
          { text: 'Beskrivelse', value: 'description' },
          { text: 'Statestik', value: 'categories' },   
          { text: 'Antal', value: 'votes' },    
          { text: 'Dato', value: 'created_at' },              
          { text: '', value: 'actions' },
      ],

      include: "categories,votes",

      move: false,


    }
    
  }


}

</script>

<style >


</style>