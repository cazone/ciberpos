<template>
  <el-dialog v-model="tikcetStore.centerDialogVisible"
    :show-close="true" title="Buscar Producto" width="50%" center :close-on-click-modal="false">

    <el-row >
        <el-table v-loading="tikcetStore.loading"
        @current-change="tikcetStore.handleCurrentChange"
         :data="tikcetStore.resumen" style="width:100%"    height="400px"  highlight-current-row>

                <el-table-column prop="id" label="ID" width="100"/>
                <el-table-column prop="name" label="Creado" >
                    <template #default="scope">
            {{ scope.row.user.name }}
        </template>
                </el-table-column>

                <el-table-column prop="total" label="Total" align="center">
        <template #default="scope">
            {{ numeralFormat(scope.row.total, '$ 0,0[.]00')  }}
        </template>


    </el-table-column>
    <el-table-column prop="created_at" label="Creado" align />
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
import { useTicketPrintStore } from "@/stores/TicketPrintStore";
const tikcetStore = useTicketPrintStore();




</script>

<style lang="scss" scoped>

</style>
