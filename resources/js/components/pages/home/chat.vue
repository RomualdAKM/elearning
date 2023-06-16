<script setup>
import axios from 'axios'
import { ref, onMounted,watch } from 'vue'

const form = ref({
    userId: '',
    message: ''
})

const messages = ref({})

const getUser = async () => {
        await axios.get('/api/user', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token')
                    }
    })
    .then(response => {

        console.log('info', response.data.id);
    form.value.userId = response.data.id

    // Appel de la fonction getMessage() ici
        getMessages()

    })
}



const getMessages = async () => {

    let response = await axios.get('/api/get_messages')
    console.log('messages', response.data.messages)
    messages.value =  response.data.messages
}

const createMessage = async () => {

    await axios.post('/api/create_message', form.value)
        .then((response) => {
            getMessages()
             form.value.message = ''
            toast.fire({
            icon: "success",
            title: "Message send Successfully",
        });
        })

}

watch(form.value, async () => {
 getUser();
});

onMounted(() => {
    getUser()


})


</script>
<template>
	<div class="container mt-5">

				<div class="col-md-8 col-xl-12 chat">
                   
					<div class="card">
						<div >
							<div class="d-flex bd-highlight">

								<div class="user_info">
									<span>Furum de discussion des apprenants</span>
									<p>Soyez polis</p>
								</div>

							</div>

						</div>
						<div class="card-body msg_card_body">

							<div class="d-flex justify-content-start mb-4" v-for="msg in messages" :key="msg.id">

								<div class="msg_cotainer">
									 {{msg.message}}
                                <span class="msg_time">envoyé par -> {{msg.user.name}} </span>

								</div>
							</div>

						</div>
						<div class="card-footer">
                            <form @submit.prevent="createMessage()">
							<div class="input-group">

								<input name="" class="form-control type_msg" v-model="form.message" placeholder="Type your message...">
								<input name="" hidden  v-model="form.userId" class="form-control type_msg" placeholder="Type your message...">
								<div class="input-group-append">
									<span class="input-group-text send_btn"> <input type="submit" value="Send">
                    </span>
								</div>
							</div>
                            </form>
						</div>
					</div>
				</div>

		</div>
</template>

<style scoped>
.chat{
			margin-top: auto;
			margin-bottom: auto;
		}
		.card{
			height: 500px;
			border-radius: 15px !important;
			background-color: rgba(0,0,0,0.4) !important;
		}
		.contacts_body{
			padding:  0.75rem 0 !important;
			overflow-y: auto;
			white-space: nowrap;
		}
		.msg_card_body{
			overflow-y: auto;
		}
		.card-header{
			border-radius: 15px 15px 0 0 !important;
			border-bottom: 0 !important;
		}
	 .card-footer{
		border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
	}
		.container{
			align-content: center;
		}
		.search{
			border-radius: 15px 0 0 15px !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
		}
		.search:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
			.type_msg:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.attach_btn{
	border-radius: 15px 0 0 15px !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.send_btn{
	border-radius: 0 15px 15px 0 !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.search_btn{
			border-radius: 0 15px 15px 0 !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.contacts{
			list-style: none;
			padding: 0;
		}
		.contacts li{
			width: 100% !important;
			padding: 5px 10px;
			margin-bottom: 15px !important;
		}
	.active{
			background-color: rgba(0,0,0,0.3);
	}
		.user_img{
			height: 70px;
			width: 70px;
			border:1.5px solid #f5f6fa;

		}
		.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;

		}
	.img_cont{
			position: relative;
			height: 70px;
			width: 70px;
	}
	.img_cont_msg{
			height: 40px;
			width: 40px;
	}
	.online_icon{
		position: absolute;
		height: 15px;
		width:15px;
		background-color: #4cd137;
		border-radius: 50%;
		bottom: 0.2em;
		right: 0.4em;
		border:1.5px solid white;
	}
	.offline{
		background-color: #c23616 !important;
	}
	.user_info{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 15px;
	}
	.user_info span{
		font-size: 20px;
		color: white;
	}
	.user_info p{
	font-size: 10px;
	color: rgba(255,255,255,0.6);
	}
	.video_cam{
		margin-left: 50px;
		margin-top: 5px;
	}
	.video_cam span{
		color: white;
		font-size: 20px;
		cursor: pointer;
		margin-right: 20px;
	}
	.msg_cotainer{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 25px;
		background-color: #f6f7f7;
        color: black;
		padding: 10px;
        font-size: 16px;
        font-weight: 900;
		position: relative;
	}
	.msg_cotainer_send{
		margin-top: auto;
		margin-bottom: auto;
		margin-right: 10px;
		border-radius: 25px;
		background-color: #78e08f;
		padding: 10px;
		position: relative;
	}
	.msg_time{

		left: 0;
		bottom: -15px;
		color: rgba(195, 35, 35, 0.5);
		font-size: 14px;
	}
	.msg_time_send{
		position: absolute;
		right:0;
		bottom: -15px;
		color: rgba(6, 6, 6, 0.515);
		font-size: 10px;
	}
	.msg_head{
		position: relative;
	}
	#action_menu_btn{
		position: absolute;
		right: 10px;
		top: 10px;
		color: white;
		cursor: pointer;
		font-size: 20px;
	}
	.action_menu{
		z-index: 1;
		position: absolute;
		padding: 15px 0;
		background-color: rgba(0,0,0,0.5);
		color: white;
		border-radius: 15px;
		top: 30px;
		right: 15px;
		display: none;
	}
	.action_menu ul{
		list-style: none;
		padding: 0;
	margin: 0;
	}
	.action_menu ul li{
		width: 100%;
		padding: 10px 15px;
		margin-bottom: 5px;
	}
	.action_menu ul li i{
		padding-right: 10px;

	}
	.action_menu ul li:hover{
		cursor: pointer;
		background-color: rgba(0,0,0,0.2);
	}
	@media(max-width: 576px){
	.contacts_card{
		margin-bottom: 15px !important;
	}
	}


</style>
