<template>
  <app-layout title="POS">
    <template #header>
    </template>
<SearchProduct />
    <div class="common-layout">
    <el-container>

      <el-header>
        <el-input

      v-model="posStore.valSearch"
      placeholder="Por favor, ingresa clave o codigo de barra del producto"
      class="input-with-select"
      @keyup.enter="posStore.searchProduct"
      clearable
    >

    </el-input>
    <el-scrollbar >


    </el-scrollbar>


      </el-header>
      <!-- <el-scrollbar>
    <div class="scrollbar-flex-content">
      <p v-for="item in 50" :key="item">
        <el-button>Default</el-button>
      </p>
    </div>
  </el-scrollbar> -->
      <el-container>
        <el-aside width="10%" >
            <el-scrollbar max-height="400px">


</el-scrollbar>
        </el-aside>

        <el-main  >
            <div class="totalitem">
										<h4>Total items : {{ posStore.products.length }}</h4>

										<a @click="posStore.delAllProducts" href="javascript:void(0);">Borrar todo</a>
									</div>
            <el-table v-loading="posStore.loading" :data="posStore.products" style="width: 100%"    height="400"  highlight-current-row>
                <el-table-column type="index" width="50" />
    <el-table-column prop="name_product" label="Producto" />
    <el-table-column prop="amount" label="Cantidad" width="150" align="center">
        <template #default="scope">
            <el-input-number v-model="scope.row.amount" :min="1" :max="10"  size="small"/>
        </template>
    </el-table-column>
    <el-table-column prop="price" label="Precio" width="150" align="center">
        <template #default="scope">
            {{ numeralFormat(scope.row.price, '$ 0,0[.]00')  }}
        </template>


    </el-table-column>
    <el-table-column prop="discount" label="Desc" width="150" align="center">
        <template #default="scope">
            {{ numeralFormat(scope.row.discount, '$ 0,0[.]00')  }}
        </template>


    </el-table-column>
    <el-table-column prop="subtotal" label="Subtotal"  align="center">

        <template #default="scope">
            {{ numeralFormat(scope.row.subtotal, '$ 0,0[.]00')  }}
        </template>


    </el-table-column>
    <el-table-column fixed="right" label="" width="60">
                <template #default="scope">
                    <el-button icon="fa fa-trash"  @click="posStore.delProduct(scope.$index )" size="small" circle  />

                </template>
                </el-table-column>

  </el-table>
  <div class="card-body pt-0 pb-2">
									<div class="setvalue">
										<ul>
											<li>
												<h4>Subtotal </h4>
												<h4>{{numeralFormat(posStore.subtotal, '$ 0,0[.]00')   }}</h4>
											</li>
											<li>
												<h4>Descuentos </h4>
												<h4>{{numeralFormat(posStore.discount, '$ 0,0[.]00')   }}</h4>
											</li>
											<li class="total-value">
												<h3>Total  </h3>
												<h3>{{numeralFormat(posStore.total, '$ 0,0[.]00')   }}</h3>
											</li>
										</ul>
                                        <el-row class="row-bg" justify="end" >
                                        <el-button  plain size="large" @click="productStore.openDialog">
                                            <img src="assets/img/icons/search.svg" alt="img" class="me-2"> Buscar Producto
                                        </el-button>
                                        <el-button  plain size="large">
                                            <img src="assets/img/icons/purchase1.svg" alt="img" class="me-2"> Corte de Caja
                                        </el-button>
                                        <el-button v-if="posStore.total>0" @click="posStore.openCenterDialog"  plain size="large">
                                            <img src="assets/img/icons/cash.svg" alt="img" class="me-2" >  Cobrar Cuenta
                                        </el-button>

  </el-row>
									</div>



								</div>
        </el-main>
      </el-container>

    </el-container>
  </div>



  <el-dialog v-model="posStore.centerDialogVisible"
 :show-close="false" title="Cobrar Cuenta" width="30%" center :close-on-click-modal="false">
    <el-row justify="center">
        <el-input
       @keyup.enter=""
        v-model="posStore.pay"
      size="large"
      placeholder="Please Input"
    />
    </el-row>
    <el-row justify="center">
        <h3>Cambio {{ posStore.change }}  </h3>
    </el-row>
    <el-row>
        <el-switch
    v-model="posStore.ticket"
    class="ml-2"
    inline-prompt
    style="--el-switch-on-color: #13ce66; --el-switch-off-color: #ff4949"
    active-text="Imprimir ticket"
    inactive-text="No imprimir ticket"
  />
</el-row>

    <template #footer>
      <span class="dialog-footer">
        <el-button @click="posStore.centerDialogVisible = false">Cancel</el-button>
        <el-button type="primary" @click="posStore.saveInvoice">
          Confirm
        </el-button>
      </span>
    </template>
  </el-dialog>

  </app-layout>
</template>
<script setup>
import { ref } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue"
import { Head, Link } from '@inertiajs/inertia-vue3'
import { usePage } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import { ElMessage } from 'element-plus'
import { usePosStore } from "@/stores/PosStore";
import SearchProduct from "@/components/SearchProduct.vue";
import { useProductStore } from "@/stores/ProductStore";
const productStore = useProductStore();

const posStore = usePosStore();






</script>
<style scoped>
.scrollbar-flex-content {
  display: flex;
}
.scrollbar-demo-item {
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100px;
  height: 50px;
  margin: 10px;
  text-align: center;
  border-radius: 4px;
  background: var(--el-color-danger-light-9);
  color: var(--el-color-danger);
}
</style>
