<template>
  <app-layout title="Dashboard">
    <template #header>

    </template>
    <div class="row">
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash1.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>$ <span class="counters" data-count="0">0</span></h5>
<h6>Total Compras Diaria</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash1">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash2.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>{{numeralFormat(sales_day, '$ 0,0[.]00') }}</h5>
<h6>Total Venta Diaria</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash2">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash3.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>{{numeralFormat(sales, '$ 0,0[.]00') }}</h5>
<h6>Total Ventas Mensual</h6>
</div>
</div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
<div class="dash-widget dash3">
<div class="dash-widgetimg">
<span><img src="assets/img/icons/dash4.svg" alt="img"></span>
</div>
<div class="dash-widgetcontent">
<h5>$ <span class="counters" data-count="0">0</span></h5>
<h6>Total Compras Mensual</h6>
</div>
</div>
</div>




</div>

  </app-layout>
</template>

<script setup >
import moment from "moment";
import {  ref , computed} from "vue"
import AppLayout from "@/Layouts/AppLayout.vue"
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from '@/Jetstream/Button.vue';
import { useForm } from '@inertiajs/inertia-vue3'
import Pagination from '@/components/Pagination.vue'
import { Inertia } from "@inertiajs/inertia";
import { usePage } from '@inertiajs/inertia-vue3'
const sales = computed(() => usePage().props.value.sales)
const mes = computed(() => usePage().props.value.mes)
const sales_day = computed(() => usePage().props.value.sales_day)

</script>
