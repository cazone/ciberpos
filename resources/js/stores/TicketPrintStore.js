import axios from 'axios';

import { defineStore } from 'pinia'
import { ref , watch, onMounted} from 'vue'
import { ElMessage } from 'element-plus'

export const useTicketPrintStore = defineStore('ticket', () => {

     const centerDialogVisible = ref(false);
     const loading = ref(false);
     const resumen = ref([]);


    onMounted(() => {

    });
    const handleCurrentChange = async(val) => {
        if (val){

            window.open(route('ticket.print', {id: val.id}), '_blank');
            centerDialogVisible.value = false;
        }
    }

    const loadResumen = async () => {
        loading.value = true;
        await axios.get(route('tickets')).then(response => {
            loading.value = false;
            console.log(response.data);
            resumen.value = response.data.data;
        }).catch(error => {
            loading.value = false;
            ElMessage.error('Oops, No se puede guardar.')
        });
    }


    // const refInput = (val) => {
    //     refNameOutlay.value = val;
    // }
    const openDialog =  async () => {

        await loadResumen();
        centerDialogVisible.value = true;
      };

    return {
        centerDialogVisible, openDialog, loading,   resumen, handleCurrentChange
    }

});
