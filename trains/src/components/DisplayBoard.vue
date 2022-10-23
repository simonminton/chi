<template>
    <ul v-if="trainData" class="rounded-md px-4 md:px-8 py-6 max-w-xl w-full mx-auto dotmatrix"> 
      <li v-for="train, indx in trainData.data" v-bind:key="indx">
        <SingleTrain :train="train" />
      </li>
    </ul>
</template>

<script>
import SingleTrain from "../components/SingleTrain.vue";

export default {
  components: {
    SingleTrain,
  },
  props: {
    msg: {
        type: String,
        required: true,
      },
  },
  data() {
    return {
      trainData: null
    }
  },
  mounted() {
    // fetch data from the API every 0 seconds
    this.getTrainData();
  },
  methods: {
    
    async getTrainData() {
      var apiUrl = 'https://api.tfl.gov.uk/StopPoint/940GZZLU'+this.$route.params.station+'/arrivals'
      if(this.$route.params.line) {
        apiUrl = 'https://api.tfl.gov.uk/Line/'+this.$route.params.line+'/Arrivals/940GZZLU'+this.$route.params.station
      }
      if(this.$route.params.destination) {
        apiUrl = 'https://api.tfl.gov.uk/Line/'+this.$route.params.line+'/Arrivals/940GZZLU'+this.$route.params.station+'?destinationStationId=940GZZLU'+this.$route.params.destination
      }
      // Fetch train data from the API
      try {
        
        const res = await fetch(apiUrl);
        

        if (!res.ok) {
          const message = `An error has occured: ${res.status} - ${res.statusText}`;
          throw new Error(message);
        }

        const data = await res.json();
        // Sort data by arrivaltime
        data.sort((a, b) => a.timeToStation - b.timeToStation);

        const result = {
          status: res.status + "-" + res.statusText,
          headers: {
            "Content-Type": res.headers.get("Content-Type"),
            "Content-Length": res.headers.get("Content-Length"),
          },
          length: res.headers.get("Content-Length"),
          data: data,
        };

        this.trainData = result;
      } catch (err) {
        this.trainData = err.message;
      }
    },
  }
};
</script>
