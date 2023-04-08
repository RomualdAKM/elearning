<script setup>
import { onMounted,ref, watch } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const name = ref(route.params.name)
const key = ref(0)

let learnings = ref({})


const getLearning = async () => {

    await axios.get(`/api/get_learning/${name.value}`)
        .then(response => {
            learnings.value = response.data.learnings

            console.log('learning',response.data.learnings)
        })
        .catch(error => {
            console.log(error)
        })

}
const switchChapter = (index) => {


  window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
  })
   key.value = index

}
watch(route, async () => {
    name.value = route.params.name
    getLearning()
})


onMounted(() => {

   getLearning()

})



</script>

<template>
  <div>

     <!-- **************** MAIN CONTENT START **************** -->

<main>


<!-- =======================
Page content START -->
<section class="pt-0">
	<div class="container">
		<div class="row g-lg-5">
            <!-- Course video START -->
			<div class="col-12 mt-3">
				<div class="video-player rounded-3">
					<video controls crossorigin="anonymous" playsinline poster="assets/images/videos/poster.jpg">
						<source :src="learnings.chapters?.[key]?.url" type="video/mp4" size="360">
						<!-- Caption files -->
						<track kind="captions" label="English" srclang="en" src="assets/images/videos/en.vtt" default>
						<track kind="captions" label="French" srclang="fr" src="assets/images/videos/fr.vtt">
					</video>
				</div>
			</div>
			<!-- Course video END -->

           <!-- Playlist responsive toggler START -->
			<div class="col-12 d-lg-none">
				<button class="btn btn-primary mb-3 mt-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
					<i class="bi bi-camera-video me-1"></i> Playlist
				</button>
			</div>
			<!-- Playlist responsive toggler END -->
			<!-- Main content START -->
			<div class="col-lg-8">
				<div class="row g-4">

					<!-- Course title START -->
					<div class="col-12">
						<!-- Title -->
						<h1>{{learnings.chapters?.[key]?.name}}</h1>

					</div>
					<!-- Course title END -->

					<!-- Instructor detail START -->
					<div class="col-12">
						<div class="d-sm-flex justify-content-sm-between align-items-center">


							<!-- Button -->
							<div class="d-flex mt-2 mt-sm-0">

								<a class="btn btn-danger-soft btn-sm mb-0" :href="learnings.chapters?.[key]?.file">Download PDF</a>

							</div>
						</div>
					</div>
					<!-- Instructor detail END -->

					<!-- Course detail START -->
					<div class="col-12">

						<!-- Tab contents START -->
						<div class="tab-content pt-4 px-3" id="course-pills-tabContent">
							<!-- Content START -->
							<div class="tab-pane fade show active" id="course-pills-1" role="tabpanel" aria-labelledby="course-pills-tab-1">
								<!-- Course detail START -->
								<h5>Course Description</h5>
								<p class="mb-3">Welcome to the <strong>{{learnings.chapters?.[key]?.description}} </strong></p>


							</div>
							<!-- Content END -->





						</div>
						<!-- Tab contents END -->
					</div>
					<!-- Course detail END -->
				</div>
			</div>
			<!-- Main content END -->

			<!-- Right sidebar START -->
			<div class="col-lg-4">
				<!-- Responsive offcanvas body START -->
				<div class="offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
					<div class="offcanvas-header bg-dark">
						<h5 class="offcanvas-title text-white" id="offcanvasSidebarLabel">Course playlist</h5>
						<button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close"><i class="bi bi-x-lg"></i></button>
					</div>
					<div class="offcanvas-body p-3 p-lg-0">
						<div class="col-12">
							<!-- Accordion START -->
							<div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
								<!-- Item -->
								<div class="accordion-item mb-3">

									<div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
										<div class="accordion-body mt-3">
                                            <h2>Chapitres : </h2>
											<div class="vstack gap-3 p-2" v-for="(chapter, index) in learnings.chapters" :key="chapter.id">
												<!-- Course lecture -->
												<div class="d-flex justify-content-between align-items-center">
													<div class="position-relative d-flex align-items-center">
														<button @click="switchChapter(index)"  class="btn btn-danger-soft btn-round btn-sm mb-0
                                                        stretched-link position-static">
															<i class="fas fa-play me-0">{{index + 1}}</i>

														</button>

														<span class="d-inline-block text-truncate
                                                         ms-2 mb-0 h6 fw-light w-200px">{{ chapter.name }}</span>
													</div>
													<!-- Button -->
                                                    <div class="d-flex mt-2 mt-sm-0">

                                                        <router-link class="btn btn-danger-soft btn-sm mb-0" :to="{name:'Quiz',params:{nameChapter: chapter.name}}">Passez au Quiz</router-link>


                                                    </div>
												</div>


											</div>
										</div>
									</div>
								</div>






							</div>
							<!-- Accordion END -->
						</div>
					</div>
				</div>
				<!-- Responsive offcanvas body END -->


			</div>
			<!-- Right sidebar END -->

		</div><!-- Row END -->
	</div>
</section>
<!-- =======================
Page content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->


  </div>
</template>
