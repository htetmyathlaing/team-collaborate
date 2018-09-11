<template>
    <div class="modal fade mt-5 mm-text" id="deleteChannelModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title mx-auto">ဖျက်မှာသေချာပြီလား?</h5>
	      		</div>
	      		<div class="modal-body">
					ယခုချန်နယ်နှင့် သက်ဆိုင်သော မက်ဆေ့ချ်များအားလုံးကို ဖျက်ပါလိမ့်မည့်။
					<div v-show="isChannelDeleting" class='container'>
			            <div class='loader'>
			                <div class='loader-text  mm-text'></div>
			            </div>
			        </div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="isChannelDeleting">မလုပ်တော့ပါ</button>
	        		<button type="button" class="btn btn-danger" @click="deleteChannel" :disabled="isChannelDeleting">ဖျက်မည်</button>
	      		</div>
	    	</div>
	  	</div>
	</div>
</template>

<script>
    export default {
        data(){
        	return {
        		isChannelDeleting: false
        	}
        },
        methods:{
        	deleteChannel(){
        		this.isChannelDeleting = true
                axios.delete('/channel/' + this.$store.state.currentGroup.id + '/' + this.$store.state.currentChannel).then(response => {
                    if(response.data.type == "channel")
                        this.$store.commit('removeChannel', response.data.id)
                    else
                        this.$store.commit('removeUser', response.data.id)

                    this.$store.commit('updateTitle', this.$store.state.currentGroup.channels[0].description)
                    this.$store.commit('updateCurrentChannel', 
                        `channel${this.$store.state.currentGroup.channels[0].id}`)

                    this.$store.commit('updateChannelDescription', 
                        this.$store.state.currentGroup.channels[0].description)

                    axios.get('/getmessages/'+this.$store.state.currentGroup.id+'/'+this.$store.state.currentChannel).then(response => {
                            this.$store.commit('assignMessages', response.data.messages)
                        }) 
                    this.isChannelDeleting = false
                    $('#deleteChannelModal').modal("hide")    
                }) 
            }
        }
    }
</script>
<style scoped>
	.container {
        font-family: Helvetica;
        padding: 1px;
        margin-bottom: 5px;
    }

  	.loader-text:after {
	    content: "ချန်နယ်ကို ဖျက်နေသည်";
	    font-weight: bold;
	    font-style: italic;
	    color: red;
	    animation-name: loading-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes loading-text {
	    0% {
	      content: "ချန်နယ်ကို ဖျက်နေသည်";
	    }
	    10% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် .";
	    }
	    20% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . .";
	    }
	    30% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . . . ";
	    }
	    40% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . . . .";
	    }
	    50% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . . . . .";
	    }
	    60% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . . . . . .";
	    }
	    70% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . . . . . . .";
	    }
	    80% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . . . . . . . .";
	    }
	    90% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . . . . . . . . .";
	    }
	    100% {
	      content: "ချန်နယ်ကို ဖျက်နေသည် . . . . . . . . . .";
	    }
	}
</style>
