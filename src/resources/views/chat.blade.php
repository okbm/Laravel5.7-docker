<html>
<body>
    <div id="chat">
        <textarea v-model="message"></textarea>

        <br>
        <button type="button" @click="send()" >送信</button>
        <div v-for="m in messages">
            <span v-text="m.created_at"></span>：&nbsp;
            <span v-text="m.body"></span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
    <script src="/js/app.js"></script>
    <script>

        new Vue({
            el: '#chat',
            data: {
                message: '',
                messages: []
            },
            methods: {
                getMessages() {
                    const url = '/ajax/chat';
                    axios.get(url)
                        .then((response) => {
                            this.messages = response.data;
                        });
                },
                send() {
                    const url = '/ajax/chat';
                    const params = { message: this.message };
                    axios.post(url, params)
                        .then((response) => {
                            this.message = '';
                        });
                }
            },
            mounted() {
                console.log("mounted");
                this.getMessages();
                Echo.channel('chat').listen('MessageCreated', (e) => {
                    console.log("listen");
                    this.getMessages();
                });
            }
        });

    </script>
</body>
</html>