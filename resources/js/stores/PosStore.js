import axios from 'axios';
import { defineStore } from 'pinia'
import { ref , watch} from 'vue'
import { ElMessage } from 'element-plus'
export const usePosStore = defineStore('pos', () => {

    const valSearch = ref('');
    const products = ref([]);
    const message = ref('');
    const loading = ref(false);
    const total = ref(0);



    watch(
        () => products,
        (newValue, oldValue) => {
            loading.value = true;
            total.value = 0;

             products.value.forEach(item => {

              item.subtotal = (item.price * item.amount) - item.discount;
              total.value += item.subtotal;
            });
            loading.value = false;
         }, { deep: true })


    const delAllProducts = () => {
        products.value = [];
    }
    const delProduct = (index) => {
        products.value.splice(index, 1);
    }
    const searchProduct = async() => {
        let searchArr = valSearch.value.split('*');

        loading.value = true;
    const { data } = await  axios.get(route('search'), {
            params: {
                query: searchArr[0]
            }
        });
       if (data.length == 0) {
        loading.value = false;
        ElMessage.error('Oops, No se encontro el producto.')
        return;

       }
       console.log(searchArr);
       const amount = searchArr[1] ? parseInt(searchArr[1]) : 1;
       const discountPorcent = 0 / 100
       const discount = (data[0].price * amount) * discountPorcent
       console.log(discount)
       const  tempProducts = {
            id: data[0].id,
            name_product: data[0].name_product,
            price: data[0].price,
            amount: amount,
            discount: discount,
            subtotal: data[0].price * amount
        };
        products.value.push(tempProducts);
        loading.value = false;
        valSearch.value = '';
    }



    return {valSearch, searchProduct, products, message, loading, total, delProduct,
        delAllProducts
    }

})
