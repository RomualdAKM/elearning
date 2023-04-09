<script setup>

import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

const bookName = ref(route.params.bookName)

const book = ref([])

const getDetailBook = async () => {

    let response = await axios.get(`/api/get_detail_book/${bookName.value}`)
        book.value = response.data.book
        console.log('mybook',response.data.book)
}
onMounted(async () => {
    await getDetailBook()
})

</script>

<template>

    <!-- **************** MAIN CONTENT START **************** -->
    <main>
        <!-- =======================
Page content START -->
        <section class="pt-5">
            <div class="container" data-sticky-container>
                <div class="row g-4 g-sm-5">
                    <!-- Left sidebar START -->
                    <div class="col-xl-4">
                        <div
                            data-sticky
                            data-margin-top="80"
                            data-sticky-for="992"
                        >
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-xl-12">
                                    <!-- Card START -->
                                    <div class="card shadow">
                                        <!-- Image -->
                                        <div class="rounded-3">
                                            <img
                                                :src="book.image"
                                                class="card-img-top"
                                                alt="book image"
                                            />
                                        </div>

                                        <!-- Card body -->
                                        <div class="card-body pb-3">
                                            <!-- Buttons and price -->
                                            <div class="text-center">
                                                <!-- Buttons -->

                                                <a
                                                    :href="book.file"
                                                    class="btn btn-light mb-0"
                                                    ><i
                                                        class="bi bi-bookmark me-2"
                                                    ></i
                                                    >Download</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card END -->
                                </div>
                            </div>
                            <!-- Row End -->
                        </div>
                    </div>
                    <!-- Left sidebar END -->

                    <!-- Main content START -->
                    <div class="col-xl-8">
                        <span>
                             <h3 class=" text-primary">
                                    Category :  {{book?.category?.name}}
                            </h3>
                        </span>

                        <!-- Title -->
                        <h1 class="mb-4 text-danger">
                            {{book.name}}
                        </h1>



                        <!-- Content -->
                        <h4 class=" text-primary">Description</h4>
                        <p class="text-white">
                            {{book.description}}
                        </p>



                    </div>
                    <!-- Main content END -->
                </div>
                <!-- Row END -->
            </div>
        </section>
        <!-- =======================
Page content END -->
    </main>
    <!-- **************** MAIN CONTENT END **************** -->
</template>
