<template>
    <el-dialog
        v-model="boxCutStore.centerDialogVisible"
        :show-close="true"
        title="Corte de Caja"
        width="30%"
        center
        :close-on-click-modal="false"
    >
        <el-row :gutter="20">
            <el-text class="mx-1" size="large"
                >Venta POS: {{ numeralFormat(boxCutStore.resumen.invoice, "$ 0,0[.]00") }}
            </el-text>
        </el-row>
        <el-row :gutter="20">
            <el-text class="mx-1" size="large">Venta directa: {{ numeralFormat(boxCutStore.resumen.sale, "$ 0,0[.]00") }}</el-text>
        </el-row>
        <el-row :gutter="20">
            <el-text class="mx-1" size="large">Gastos : {{ numeralFormat(boxCutStore.resumen.outlay, "$ 0,0[.]00") }}</el-text>
        </el-row>
        <el-divider></el-divider>
        <el-row :gutter="20">
            <el-text class="mx-1" size="large">Total sistema : {{ numeralFormat(boxCutStore.resumen.total, "$ 0,0[.]00") }}</el-text>
        </el-row>
        <el-row :gutter="20">
            <input
                type="text"
                v-model="boxCutStore.cash"
                placeholder="Por favor, ingresa total de efectivo"
               >

        </el-row>
        <el-row :gutter="20">
            <el-text class="mx-1" size="large">Diferencia  : {{ numeralFormat(boxCutStore.totalUser , "$ 0,0[.]00") }}</el-text>

        </el-row>
        <template #footer>
            <span class="dialog-footer">
                <el-button @click="boxCutStore.centerDialogVisible = false"
                    >Cancel</el-button
                >

                <el-button
                     v-if="boxCutStore.cash > 0"
                    v-loading="boxCutStore.loading"
                    type="primary"
                    @click="boxCutStore.save"
                >
                    Guardar
                </el-button>
            </span>
        </template>
    </el-dialog>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useBoxCutStore } from "@/stores/BoxCutStore";
const boxCutStore = useBoxCutStore();

// onMounted(() => {

// console.log('com' ,refName.value);
//     boxCutStore.refInput(refName.value );

// })
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
