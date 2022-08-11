<template>
<nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">

                <li
                    v-for="link in links.links"
                    class="page-item"
                    :class="{ active: link.active }"
                >
                    <Link
                        class="page-link"
                        :href="link.url + '&pages=' + pages"
                        v-html="link.label"
                    ></Link>
                </li>
                <li><div style="padding: .375rem .75rem;">Mostrando del <strong>{{links.from}}</strong> al <strong>{{links.to}}</strong> de <strong>{{links.total}} </strong> {{text}}</div></li>

            </ul>
        </nav>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
    export default {
        props: ['links',
        'text', 'pages', 'ruta'],
        components: {Link
        },
        data() {
            return {
                value:this.pages,
               options : [
                 {
                   value: '10',
                   label: '1 - 10',
                 },
                 {
                   value: '20',
                   label: '11 - 20',
                 },
                 {
                   value: '30',
                   label: '21 - 30',
                 },
                 {
                   value: '40',
                   label: '31 - 40',
                 },
                 {
                   value: '50',
                   label: '41 - 50',
                 },
                 {
                   value: '100',
                   label: '51 - 100',
                 },
               ]
            };
        },
        methods: {
            change() {
                console.log(this.pages)

                this.$inertia.get(route(this.ruta, {
                    pages: this.value
                }))

            }
        },

    }
</script>

<style lang="scss" scoped>

</style>
