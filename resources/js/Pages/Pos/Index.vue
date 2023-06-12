<template>
  <app-layout title="Lista">
    <template #header>
    </template>

    <div class="common-layout">
    <el-container>
      <el-header>
        <el-input
      v-model="input3"
      placeholder="Please input"
      class="input-with-select"
    >
      <template #prepend>
        <el-select v-model="select" placeholder="Select" style="width: 115px">
          <el-option label="Restaurant" value="1" />
          <el-option label="Order No." value="2" />
          <el-option label="Tel" value="3" />
        </el-select>
      </template>
      <template #append>
        <el-button :icon="Search" />
      </template>
    </el-input>
      </el-header>
      <el-container>
        <el-aside width="300px" >

        </el-aside>
        <el-main  >
            <el-table :data="tableData" style="width: 100%; height:400px">
    <el-table-column prop="date" label="Date" width="180" />
    <el-table-column prop="name" label="Name" width="180" />
    <el-table-column prop="address" label="Address" />
  </el-table>
        </el-main>
      </el-container>
      <el-footer>

        <div class="setvaluecash">
										<ul>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/cash.svg" alt="img" class="me-2">
													Cash
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/debitcard.svg" alt="img" class="me-2">
													Debit
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="paymentmethod">
													<img src="assets/img/icons/scan.svg" alt="img" class="me-2">
													Scan
												</a>
											</li>
										</ul>
									</div></el-footer>
    </el-container>
  </div>
  </app-layout>
</template>
<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue"
import { Head, Link } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import { ElMessage } from 'element-plus'
const input3 = ref('')
const select = ref('')

const tableData = [
  {
    date: '2016-05-03',
    name: 'Tom',
    address: 'No. 189, Grove St, Los Angeles',
  },
  {
    date: '2016-05-02',
    name: 'Tom',
    address: 'No. 189, Grove St, Los Angeles',
  },
  {
    date: '2016-05-04',
    name: 'Tom',
    address: 'No. 189, Grove St, Los Angeles',
  },
  {
    date: '2016-05-01',
    name: 'Tom',
    address: 'No. 189, Grove St, Los Angeles',
  },
]

</script>
