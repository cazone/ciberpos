import axios from 'axios';
import { defineStore } from 'pinia'
import { ref , watch} from 'vue'
import { ElMessage } from 'element-plus'
export const usePosStore = defineStore('pos', () => {

    const valSearch = ref('');
    const products = ref([]);
    const message = ref('');
    const loading = ref(false);

    watch(
        () => products,
        (newValue, oldValue) => {
        console.log('www');

         }, { deep: true })

    const searchProduct = async() => {
        loading.value = true;
    const { data } = await  axios.get(route('search'), {
            params: {
                query: valSearch.value
            }
        });
       if (data.length == 0) {
        loading.value = false;
        ElMessage.error('Oops, No se encontro el producto.')
        return;

       }
       const  tempProducts = {
            id: data[0].id,
            name_product: data[0].name_product,
            price: data[0].price,
            amount: 1,
            total: data[0].price
        };
        products.value.push(tempProducts);
        loading.value = false;
        valSearch.value = '';
    }



    return {valSearch, searchProduct, products, message, loading, }

})
