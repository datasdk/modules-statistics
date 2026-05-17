//require("@/bootstrap");


import StatisticsIndex from "./../../views/StatisticsIndex.vue"

import StatisticsEdit from "./../../views/StatisticsEdit.vue"



window.router.addRoute({ path: '/statistics', component: StatisticsIndex, name: "module.statistics.index"})

window.router.addRoute({ path: '/statistics/create', component: StatisticsEdit, name: "module.statistics.create" })

window.router.addRoute({ path: '/statistics/:id/edit', component: StatisticsEdit, name: "module.statistics.edit", props: true })

