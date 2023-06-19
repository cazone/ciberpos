<template>
  <el-dialog v-model="productStore.centerDialogVisible"
    :show-close="true" title="Buscar Producto" width="50%" center :close-on-click-modal="false">
    <el-row>
        <el-input

v-model="productStore.valSearch"
placeholder="Por favor, ingresa clave o codigo de barra del producto"
class="input-with-select"
@keyup.enter=""
clearable
>
</el-input>
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

</style>
