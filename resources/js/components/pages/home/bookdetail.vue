<script setup>

import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import myBase from '../../mybase.vue'
import  myFooter from './footer.vue'


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

  <div>
        <my-base></my-base>

      <!-- **************** MAIN CONTENT START **************** -->
    <main>

     <!-- =======================
Page Banner START -->
<section class="py-0">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="bg-light p-4 rounded-3 position-relative overflow-hidden">

					<!-- Svg decoration -->
					<figure class="position-absolute top-0 end-0 mt-5">
						<svg width="566.3px" height="353.7px" viewBox="0 0 566.3 353.7"	>
							<path stroke="#17a2b8" fill="none" d="M525.1,4c8.1,0.7,14.9,7.2,17.9,14.8c3,7.6,3,16,2.1,24.1c-4.7,44.3-32.1,84.7-69.4,108.9 c-37.4,24.2-83.7,32.8-127.9,27.6c-32.3-3.8-63.5-14.5-95.9-16.6c-21.6-1.4-45.6,2.1-60.1,18.3c-7.7,8.5-11.8,19.6-14.8,30.7 c-7.9,29.5-9,60.8-19.7,89.5c-5.5,14.8-14,29.1-27.1,38c-15.6,10.5-35.6,12-54.2,9.5c-18.6-2.5-36.5-8.6-55-12.1"/>
							<path stroke="#F99D2B" fill="none" d="M560.7,0.2c10,18.3,3.7,41.1-5,60.1c-11.8,25.9-28,50.3-50.2,68.2c-29,23.3-66.3,34-103.2,38.6 c-36.9,4.6-74.3,3.8-111.3,7.2c-22.3,2-45.3,5.9-63.5,19c-26.8,19.2-39,55.3-68.3,70.4c-38.2,19.6-89.7-4.9-125.6,18.8 c-22.6,15-30.7,44.2-33.3,71.2"/>
						</svg>
					</figure>

					<div class="row position-relative align-items-center">

						<!-- Content -->
						<div class="col-md-6 px-md-5">
							<!-- Title -->
							<h1 class="mb-3">Bienvenue dans notre librairie en ligne !</h1>

						
						</div>

						<!-- Image -->
						<div class="col-md-6 text-center">
							<img src="assets/images/book/book-bg.svg" alt="">
						</div>
					</div> <!-- Row END -->
				</div>
			</div>
		</div> <!-- Row END -->
	</div>
</section>
<!-- =======================
Page Banner END -->
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

                                            <img :src=" book.image" class="card-img-top">

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
<my-footer></my-footer>

    </main>
    <!-- **************** MAIN CONTENT END **************** -->
  </div>
</template>
