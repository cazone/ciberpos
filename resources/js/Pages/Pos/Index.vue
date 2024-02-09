<template>
  <app-layout title="POS">
    <template #header> </template>
    <SearchProduct />
    <Outlay />
    <Sale />
    <BoxCutStore />
    <TicketPrint />
    <div class="common-layout">
      <el-container>
        <el-header>
          <input
            ref="refSearch"
            v-model="posStore.valSearch"
            @keyup.enter="posStore.searchProduct"
            type="text"
            placeholder="Por favor, ingresa clave o codigo de barra del producto (F1)"
            key=""
          />

          <!-- <el-input

                    style="  background-color: lightblue;border: 2px solid red;
  border-radius: 4px;"
  size="large"
                        ref="refSearch"
                        v-model="posStore.valSearch"
                        placeholder="Por favor, ingresa clave o codigo de barra del producto"
                        class="my-paragraph"
                        @keyup.enter="posStore.searchProduct"
                        clearable
                    >
                    </el-input> -->
        </el-header>

        <el-container>
          <el-aside width="10%">
            <el-scrollbar max-height="400px">
              <ul class="inbox-menu">
                <li>
                  <a
                    href="javascript:void(0);"
                    v-for="item in favorites"
                    :key="item.id"
                    @click="addFavorite(item)"
                    ><i class="far fa-star"> </i> {{ item.name_product }}</a
                  >
                </li>
              </ul>
            </el-scrollbar>
          </el-aside>

          <el-main>
            <div class="totalitem">
              <h4>Total items : {{ posStore.products.length }}</h4>

              <el-button size="large" @click="tikcetStore.openDialog">
                <h3>Reimprimir Ticket</h3>
              </el-button>
              <el-button size="large" @click="productStore.openDialog" type="primary">
                <h3>Buscar Producto (F4)</h3>
              </el-button>
              <el-button @click="posStore.delAllProducts" type="danger" plain>
                <i
                  class="fa fa-trash"
                  data-bs-toggle="tooltip"
                  title=""
                  data-bs-original-title="fa fa-trash"
                  aria-label="fa fa-trash"
                ></i>
                Borrar todo</el-button
              >
            </div>

            <el-table
              v-loading="posStore.loading"
              :data="posStore.products"
              style="width: 100%"
              height="300"
              highlight-current-row
            >
              <el-table-column type="index" width="50" />
              <el-table-column prop="name_product" label="Producto" />
              <el-table-column prop="amount" label="Cantidad" width="150" align="center">
                <template #default="scope">
                  <el-input-number v-model="scope.row.amount" :min="1" size="small" />
                </template>
              </el-table-column>
              <el-table-column prop="price" label="Precio" width="150" align="center">
                <template #default="scope">
                  {{ numeralFormat(scope.row.price, "$ 0,0[.]00") }}
                </template>
              </el-table-column>
              <el-table-column prop="discount" label="Desc" width="150" align="center">
                <template #default="scope">
                  {{ numeralFormat(scope.row.discount, "$ 0,0[.]00") }}
                </template>
              </el-table-column>
              <el-table-column prop="subtotal" label="Subtotal" align="center">
                <template #default="scope">
                  {{ numeralFormat(scope.row.subtotal, "$ 0,0[.]00") }}
                </template>
              </el-table-column>
              <el-table-column fixed="right" label="" width="60">
                <template #default="scope">
                  <el-button
                    icon="fa fa-trash"
                    @click="posStore.delProduct(scope.$index)"
                    size="small"
                    circle
                  />
                </template>
              </el-table-column>
            </el-table>
            <div class="card-body pt-0 pb-2">
              <div class="setvalue">
                <ul>
                  <li>
                    <h4>Subtotal</h4>
                    <h4>
                      {{ numeralFormat(posStore.subtotal, "$ 0,0[.]00") }}
                    </h4>
                  </li>
                  <li>
                    <h4>
                      Descuentos
                      <input
                        v-model="posStore.descuento"
                        style="width: 250px"
                        type="text"
                        placeholder="Aplicar descuento"
                        key=""
                      />
                    </h4>

                    <h4>
                      {{ numeralFormat(posStore.discount, "$ 0,0[.]00") }}
                    </h4>
                  </li>
                  <li class="total-value">
                    <h2>Total</h2>
                    <h2>
                      {{ numeralFormat(posStore.total, "$ 0,0[.]00") }}
                    </h2>
                  </li>
                </ul>
                <el-row class="row-bg" justify="end">
                  <el-button plain size="large" @click="outlayStore.openDialog">
                    <img src="assets/img/icons/dash4.svg" alt="img" class="me-2" />
                    <h2>Agregar Gasto (F2)</h2>
                  </el-button>
                  <el-button type="warning" size="large" @click="saleStore.openDialog">
                    <img src="assets/img/icons/dash2.svg" alt="img" />
                    <h2>Agregar Venta (F3)</h2>
                  </el-button>

                  <el-button @click="boxCutStore.openDialog" type="info" size="large">
                    <img src="assets/img/icons/purchase1.svg" alt="img" class="me-2" />
                    <h2>Corte de Caja</h2>
                  </el-button>
                  <el-button
                    v-if="posStore.total > 0"
                    @click="posStore.openCenterDialog"
                    size="large"
                    type="success"
                  >
                    <img src="assets/img/icons/cash.svg" alt="img" class="me-2" />
                    <h2>Cobrar Cuenta</h2>
                  </el-button>
                </el-row>
              </div>
            </div>
          </el-main>
        </el-container>
      </el-container>
    </div>

    <el-dialog
      v-model="posStore.centerDialogVisible"
      :show-close="false"
      title="Cobrar Cuenta"
      width="30%"
      center
      :close-on-click-modal="false"
    >
      <el-row justify="center">
        <input
          type="text"
          v-model="posStore.pay"
          placeholder="porfavor ingrese el pago"
        />
      </el-row>
      <el-row justify="center">
        <h3>Cambio {{ posStore.change }}</h3>
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
          <el-button type="primary" @click="posStore.saveInvoice"> Confirmar </el-button>
        </span>
      </template>
    </el-dialog>
  </app-layout>
</template>
<script setup>
import { ref, computed, onMounted } from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { usePage } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import { ElMessage } from "element-plus";
import { usePosStore } from "@/stores/PosStore";
import SearchProduct from "@/components/SearchProduct.vue";
import Outlay from "@/components/Outlay.vue";
import Sale from "@/components/Sale.vue";
import BoxCutStore from "@/components/BoxCut.vue";
import TicketPrint from "@/components/TicketPrint.vue";
import { useProductStore } from "@/stores/ProductStore";
import { onKeyStroke } from "@vueuse/core";
import { useOutlayStore } from "@/stores/OutlayStore";
import { useSaleStore } from "@/stores/SaleStore";
import { useBoxCutStore } from "@/stores/BoxCutStore";
import { useTicketPrintStore } from "@/stores/TicketPrintStore";
const tikcetStore = useTicketPrintStore();

const boxCutStore = useBoxCutStore();
const saleStore = useSaleStore();
const outlayStore = useOutlayStore();

const categories = computed(() => usePage().props.value.categories);
const favorites = computed(() => usePage().props.value.favorites);

const productStore = useProductStore();

const posStore = usePosStore();

const refSearch = ref(null);

onMounted(() => {
  refSearch.value.focus();
});

const addFavorite = (data) => {
  posStore.saveSetInvoice(data);
};
onKeyStroke(["F1", "F2", "F3", "F4"], (e) => {
  switch (e.code) {
    case "F1":
      refSearch.value.focus();
      break;
    case "F2":
      outlayStore.openDialog();
      break;
    case "F3":
      saleStore.openDialog();
      break;
    case "F4":
      productStore.openDialog();
      break;

    default:
      break;
  }

  e.preventDefault();
});
</script>
<style scoped>
input:focus {
  outline: none !important;
  border-color: #719ece;
  box-shadow: 0 0 10px #719ece;
  background-color: aquamarine;
}
input {
  border: 2px solid red;
  border-radius: 4px;
  width: 100%;
  height: 50px;
  font-size: 22px;
  caret-shape: underscore;
  caret-color: red;
  caret-color: #ff0000;
  caret-color: rgb(255, 0, 0);
  caret-color: hsl(0, 97%, 50%);
}

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
