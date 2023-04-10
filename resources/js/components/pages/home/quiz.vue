<script setup>
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const route = useRoute()

const nameChapter = ref(route.params.nameChapter)
const quizzes = ref([])
const currentQuestionIndex = ref(0)
const userResponses = ref({})
const score = ref(0)
const quizCompleted = ref(false)

const getQuizzes = async () => {
    let response = await axios.get(`/api/get_quizzes/${nameChapter.value}`)
    quizzes.value = response.data.quizzes.quizzes
}

const selectResponse = (response) => {
    userResponses.value[currentQuestionIndex.value] = response
}

const nextQuestion = () => {
    if (currentQuestionIndex.value + 1 < quizzes.value.length) {
        currentQuestionIndex.value += 1
    } else {
        finishQuiz()
    }
}

const finishQuiz = () => {
    let userScore = 0
    let unansweredQuestions = []
    quizzes.value.forEach((quiz, index) => {
        if (userResponses.value[index] === quiz.response) {
            userScore += 1
        } else {
            unansweredQuestions.push(quiz)
        }
    })
    score.value = userScore
    quizCompleted.value = true

    if (unansweredQuestions.length > 0) {
        let unansweredQuestionsText = "Votre score est de : " + score.value + "/" + quizzes.value.length + "\n\n"
            + "Listes des mauvaises questions:\n"
        unansweredQuestions.forEach((quiz, index) => {
            unansweredQuestionsText += `${index + 1}. ${quiz.question}\n`
        })

        Swal.fire(unansweredQuestionsText)
    }
}


onMounted(async () => {
    await getQuizzes()
})

</script>
<template>
    <div class="container">
        <div v-if="!quizCompleted">
            <div v-if="quizzes.length > 0">
                <div v-for="(quiz, index) in quizzes" :key="quiz.id" v-show="index === currentQuestionIndex">
                    <h4>{{ quiz.question }}</h4>
                    <hr>
                    <div class="vstack gap-2">
                        <div>
                            <input type="radio" class="btn-check" :id="'option1-' + quiz.id" :value="quiz.option1" v-model="userResponses[currentQuestionIndex]" @change="selectResponse(quiz.option1)">
                            <label class="btn btn-outline-primary w-100" :for="'option1-' + quiz.id">{{ quiz.option1 }}</label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" :id="'option2-' + quiz.id" :value="quiz.option2" v-model="userResponses[currentQuestionIndex]" @change="selectResponse(quiz.option2)">
                            <label class="btn btn-outline-primary w-100" :for="'option2-' + quiz.id">{{ quiz.option2 }}</label>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" :id="'option3-' + quiz.id" :value="quiz.option3" v-model="userResponses[currentQuestionIndex]" @change="selectResponse(quiz.option3)">
                            <label class="btn btn-outline-primary w-100" :for="'option3-' + quiz.id">{{ quiz.option3 }}</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="button" class="btn btn-primary next-btn mb-0" @click="nextQuestion">Next question</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="quizCompleted">
            <h4 class="text-danger mt-4">Vous avez finis le questionnaire!</h4>
            <h5 class="mt-4 mb-5">Votre  score est : {{ score }}/{{ quizzes.length }}</h5>

        </div>
    </div>
</template>
