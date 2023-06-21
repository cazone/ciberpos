import axios from 'axios';

import { defineStore } from 'pinia'
import { ref , watch, onMounted} from 'vue'


export const useOutlayStore = defineStore('outlay', () => {

    const centerDialogVisible = ref(false);
    const name = ref('');
    const pay = ref(0);
    const loading = ref(false);
    const refNameOutlay = ref();

    const saveOutlay = async () => {
//TODO vaildar campos
        loading.value = true;
        await axios.post(route('outlay.store'), {
            name_outlay: name.value,
            total: pay.value

        }).catch(error => {
            loading.value = false;
            ElMessage.error('Oops, No se puede guaradar.')

        });
        centerDialogVisible.value = false;
        loading.value = false;
    }
    // const refInput = (val) => {
    //     refNameOutlay.value = val;
    // }
    const openDialog =  async () => {

        name.value = '';
        pay.value = '';

        centerDialogVisible.value = true;
      };

    return {
        centerDialogVisible, openDialog, name, pay, saveOutlay,  refNameOutlay, loading
    }

});
