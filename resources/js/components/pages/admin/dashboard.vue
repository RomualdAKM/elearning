<script setup>
import sideBar from "./sidebar.vue";
</script>

<template>
    <main>
        <!-- =======================
Page Banner START -->
        <section class="pt-0">
            <!-- Main banner background image -->
            <div class="container-fluid px-0">
                <div
                    class="bg-blue h-100px h-md-200px rounded-0"
                    style="
                        background: url(assets/images/pattern/04.png) no-repeat
                            center center;
                        background-size: cover;
                    "
                ></div>
            </div>
            <div class="container mt-n4">
                <div class="row">
                    <!-- Profile banner START -->
                    <div class="col-12">
                        <div class="card bg-transparent card-body p-0">
                            <div class="row d-flex justify-content-between">
                                <!-- Avatar -->
                                <div class="col-auto mt-4 mt-md-0">
                                    <div class="avatar avatar-xxl mt-n3">
                                        <img
                                            class="avatar-img rounded-circle border border-white border-3 shadow"
                                            src="assets/images/avatar/01.jpg"
                                            alt=""
                                        />
                                    </div>
                                </div>
                                <!-- Profile info -->
                                <div
                                    class="col d-md-flex justify-content-between align-items-center mt-4"
                                >
                                    <div>
                                        <h1 class="my-1 fs-4">
                                            Admin
                                            <i
                                                class="bi bi-patch-check-fill text-info small"
                                            ></i>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Profile banner END -->

                        <!-- Advanced filter responsive toggler START -->
                        <!-- Divider -->
                        <hr class="d-xl-none" />
                        <div
                            class="col-12 col-xl-3 d-flex justify-content-between align-items-center"
                        >
                            <a class="h6 mb-0 fw-bold d-xl-none" href="#"
                                >Menu</a
                            >
                            <button
                                class="btn btn-primary d-xl-none"
                                type="button"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasSidebar"
                                aria-controls="offcanvasSidebar"
                            >
                                <i class="fas fa-sliders-h"></i>
                            </button>
                        </div>
                        <!-- Advanced filter responsive toggler END -->
                    </div>
                </div>
            </div>
        </section>
        <!-- =======================
Page Banner END -->

        <!-- Main content START -->
        <section>
            <div class="container">
                <div class="row">
                    <side-bar></side-bar>
                    <div class="col-xl-9">
                        <!-- Counter boxes START -->
                        <div class="row g-4">
                            <!-- Counter item -->
                            <div class="col-sm-6 col-lg-4">
                                <div
                                    class="d-flex justify-content-center align-items-center p-4 bg-warning bg-opacity-15 rounded-3"
                                >
                                    <span class="display-6 text-warning mb-0"
                                        ><i class="fas fa-tv fa-fw"></i
                                    ></span>
                                    <div class="ms-4">
                                        <div class="d-flex">
                                            <h5
                                                class="purecounter mb-0 fw-bold"
                                                data-purecounter-start="0"
                                                data-purecounter-end="25"
                                                data-purecounter-delay="200"
                                            >
                                                0
                                            </h5>
                                        </div>
                                        <span class="mb-0 h6 fw-light"
                                            >Total Courses</span
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- Counter item -->
                            <div class="col-sm-6 col-lg-4">
                                <div
                                    class="d-flex justify-content-center align-items-center p-4 bg-purple bg-opacity-10 rounded-3"
                                >
                                    <span class="display-6 text-purple mb-0"
                                        ><i
                                            class="fas fa-user-graduate fa-fw"
                                        ></i
                                    ></span>
                                    <div class="ms-4">
                                        <div class="d-flex">
                                            <h5
                                                class="purecounter mb-0 fw-bold"
                                                data-purecounter-start="0"
                                                data-purecounter-end="25"
                                                data-purecounter-delay="200"
                                            >
                                                0
                                            </h5>
                                            <span class="mb-0 h5">K+</span>
                                        </div>
                                        <span class="mb-0 h6 fw-light"
                                            >Total Students</span
                                        >
                                    </div>
                                </div>
                            </div>
                            <!-- Counter item -->
                            <div class="col-sm-6 col-lg-4">
                                <div
                                    class="d-flex justify-content-center align-items-center p-4 bg-info bg-opacity-10 rounded-3"
                                >
                                    <span class="display-6 text-info mb-0"
                                        ><i class="fas fa-gem fa-fw"></i
                                    ></span>
                                    <div class="ms-4">
                                        <div class="d-flex">
                                            <h5
                                                class="purecounter mb-0 fw-bold"
                                                data-purecounter-start="0"
                                                data-purecounter-end="12"
                                                data-purecounter-delay="300"
                                            >
                                                0
                                            </h5>
                                            <span class="mb-0 h5">K</span>
                                        </div>
                                        <span class="mb-0 h6 fw-light"
                                            >Enrolled Students</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Counter boxes END -->

                        <!-- Chart START -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div
                                    class="card card-body bg-transparent border p-4 h-100"
                                >
                                    <div class="row g-4">
                                        <!-- Content -->
                                        <div class="col-sm-6 col-md-4">
                                            <span class="badge text-bg-dark"
                                                >Current Month</span
                                            >
                                            <h4 class="text-primary my-2">
                                                $35000
                                            </h4>
                                            <p class="mb-0">
                                                <span class="text-success me-1"
                                                    >0.20%<i
                                                        class="bi bi-arrow-up"
                                                    ></i></span
                                                >vs last month
                                            </p>
                                        </div>
                                        <!-- Content -->
                                        <div class="col-sm-6 col-md-4">
                                            <span class="badge text-bg-dark"
                                                >Last Month</span
                                            >
                                            <h4 class="my-2">$28000</h4>
                                            <p class="mb-0">
                                                <span class="text-danger me-1"
                                                    >0.10%<i
                                                        class="bi bi-arrow-down"
                                                    ></i></span
                                                >Then last month
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Apex chart -->
                                    <div id="ChartPayout"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Chart END -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content END -->
    </main>
</template>
