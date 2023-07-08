<template>
  <el-dialog v-model="productStore.centerDialogVisible"
    :show-close="true" title="Buscar Producto" width="50%" center :close-on-click-modal="false">
    <el-row>
        <input
type="text"
v-model="productStore.valSearch"
placeholder="Por favor, ingresa clave o codigo de barra del producto"


>

    </el-row>
    <el-row >
        <el-table v-loading="productStore.loading"
        @current-change="productStore.handleCurrentChange"
         :data="productStore.products" style="width:100%"    height="400px"  highlight-current-row>
                <el-table-column type="index" width="50" />
                <el-table-column prop="code" label="Codigo" width="100"/>
                <el-table-column prop="name_product" label="Producto" />

                <el-table-column prop="price" label="Precio" width="150" align="center">
        <template #default="scope">
            {{ numeralFormat(scope.row.price, '$ 0,0[.]00')  }}
        </template>


    </el-table-column>
    <el-table-column prop="quantity" label="Stock" width="150" align />
        </el-table>
    </el-row>

    <template #footer>
      <span class="dialog-footer">
        <!-- <el-button @click="posStore.centerDialogVisible = false">Cancel</el-button>
        <el-button type="primary" @click="posStore.saveInvoice">
          Confirm
        </el-button> -->
      </span>
    </template>
  </el-dialog>
</template>

<script setup>
import { useProductStore } from "@/stores/ProductStore";
const productStore = useProductStore();




</script>

<style lang="scss" scoped>
input:focus {
    outline: none !important;
    border-color: #719ECE;
    box-shadow: 0 0 10px #719ECE;
    background-color: aquamarine;
 }
 input {
    border: 2px solid red;
                     border-radius: 4px; width: 100%; height: 50px; font-size: 22px;
 caret-color: red;
 caret-color: #ff0000;
 caret-color: rgb(255, 0, 0);
 caret-color: hsl(0, 97%, 50%);
}
</style>
