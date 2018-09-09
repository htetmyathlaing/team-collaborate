<template>
    <div class="modal fade mt-5" id="videoCallModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	  	<div class="modal-dialog modal-lg" role="document">
	    	<div class="modal-content bg-dark">
	      		<div class="modal-body text-center py-5">
	        		<span class="fas fa-10x fa-user text-muted m-5"></span>
	        		<br>
	        		<!-- <span class="calling-text mt-5"></span> -->
	        		<br>
	        		<span class="text-danger m-5">ယခုလောလောဆယ်တွင် ခေါ်ဆို၍ မရနိုင်သေးပါ။</span>
	        		<br>
	        		<button type="button" class="btn btn-danger mt-5" data-dismiss="modal">မလုပ်တော့ပါ</button>
	      		</div>
	    	</div>
	  	</div>
	</div>
</template>

<script>
    export default {
        data(){
        	return {
        	}
        },
        methods:{
        }
    }
</script>
<style scoped>
	.calling-text:after {
	    content: "ဖုန်းခေါ်နေသည်";
	    font-weight: bold;
	    font-style: italic;
	    color: #28a745;
	    animation-name: saving-text;
	    animation-duration: 1s;
	    animation-iteration-count: infinite;
	}

	 @keyframes saving-text {
	    0% {
	      content: "ဖုန်းခေါ်နေသည်";
	    }
	    10% {
	      content: "ဖုန်းခေါ်နေသည် .";
	    }
	    20% {
	      content: "ဖုန်းခေါ်နေသည် . .";
	    }
	    30% {
	      content: "ဖုန်းခေါ်နေသည် . . . ";
	    }
	    40% {
	      content: "ဖုန်းခေါ်နေသည် . . . .";
	    }
	    50% {
	      content: "ဖုန်းခေါ်နေသည် . . . . .";
	    }
	    60% {
	      content: "ဖုန်းခေါ်နေသည် . . . . . .";
	    }
	    70% {
	      content: "ဖုန်းခေါ်နေသည် . . . . . . .";
	    }
	    80% {
	      content: "ဖုန်းခေါ်နေသည် . . . . . . . .";
	    }
	    90% {
	      content: "ဖုန်းခေါ်နေသည် . . . . . . . . .";
	    }
	    100% {
	      content: "ဖုန်းခေါ်နေသည် . . . . . . . . . .";
	    }
	}
</style>
