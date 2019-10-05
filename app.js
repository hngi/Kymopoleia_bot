const Slackbot = require('slackbots');
const request =  require('request');
const dotenv = require('dotenv');
const fs = require('fs');
const readline = require('readline');
const {google} = require('googleapis');;
const express = require('express');
const axios = require('axios');
const app = express();


const port = process.env.PORT || 3000


  




dotenv.config();


// google drive api
async function uploadFile(bucketName, filename) {
    // [START storage_upload_file]
    // Imports the Google Cloud client library
    const {Storage} = require('@google-cloud/storage');
  
    // Creates a client
    const storage = new Storage();
  
    const bucketName = 'kymoslack';
    const filename = '/home/Codes/slackbot-project/kymobot.json';

  
    // Uploads a local file to the bucket
    await storage.bucket(bucketName).upload(filename, {
      // Support for HTTP requests made with `Accept-Encoding: gzip`
      gzip: true,
      // By setting the option `destination`, you can change the name of the
      // object you are uploading to a bucket.
      metadata: {
        // Enable long-lived HTTP caching headers
        // Use only if the contents of the file will never change
        // (If the contents will change, use cacheControl: 'no-cache')
        cacheControl: 'public, max-age=31536000',
      },
    });
  
    console.log(`${filename} uploaded to ${bucketName}.`);
    // [END storage_upload_file]
  }


  require(`yargs`)
  .demand(1)
  .command(
    `upload <bucketName> <srcFileName>`,
    `Uploads a local file to a bucket.`,
    {},
    opts => uploadFile(opts.bucketName, opts.srcFileName)
  )
  
// BOT BEHAVIOUR

// bot interaction configuration
const bot = new Slackbot({
    token: `${process.env.BOT_TOKEN}`,
    name: 'kymobot'
})

bot.on('start', () => {
    const params = {
        icon_emoji: ':sunglasses:'
    }

    bot.postMessageToChannel(
        'general',
        'Hi,i am kymobot, how may i be of help or save your notes?',
        params
    );

})





// Slackbot error handler

bot.on('error', (err) => {
    console.log(err)
})

// Slackbot Message handler

bot.on('message', (data) => {
    if (data.type !== "message") {
        return;
    }
    

    // this handles the particular message we want to deliver back

    handleMessage(data.text);

    
})

// Slackbot response handler

function handleMessage(message){

    if(message.includes('hello')) {
        sendGreeting();
    }else if(message.includes(' kymosave')){
       kymoSaver();
    }else if(message.includes(' kymohelp')){
        kymoHelp();
    }
    else 
    if(message.includes(' random joke')) {
        randomJoke()
    } else if (message.includes(' kymoterms')){
        kymoTerms();
    }
    
}

// bot behaviour functions

// function that saves a channel history's conversation into an external drive.
function kymoSaver(){
    request(`https://slack.com/api/conversations.history?token=${process.env.SLACK_AUTH_LEGACY_TOKEN}&channel=${process.env.CHANNEL}&pretty=1`,(err,res,body)=>{

        fs.writeFile('kymobot.json',body,(err)=>{
            if(err)
                console.log(err)
        
                const params = {
                    icon_emoji: ':carlton:'
                  }
            bot.postMessageToChannel(
                'kymopoleia',
                "Your note has been saved",params
            );
            console.log('note has been saved')
        });
      
    });
    
}

// function designed to help user to find needed help

function kymoHelp(){
    const params ={
        icon_emoji: ":thinking:"
    }
    bot.postMessageToChannel(
        'general',
        "Type `kymosave` to save channel conversation",
        params
    )
}

//function designed to send a greeting 
function sendGreeting() {
    const greeting = getGreeting();
    bot.postMessageToChannel('random', greeting)



}

//function designed to describe terms and conditions used for the slackbot 
function kymoTerms(){
    const params ={
        icon_emoji: ":thinking:"
    } 

    bot.postMessageToChannel(
        'general',
        "Kymopoleia Privacy Policy & Terms of Service.We request permissions only to:Save your conversations in an external drive.Send messages to you privately in Slack that only you can see regarding errors or other state messages.We won't:Use emails we have access to in your workspace for any purpose other than scheduling messages as expected View any of your messages. Your messages are stored in the external drive for easy access in the future Store any personal information on our database regarding names, emails or other personal information aside from information needed to carry out service expected. That includes Slack User ID if that user has granted the app permission",
        params
    )
}

// function used to get needed greeting 

function getGreeting() {
    const greetings = [
        'hello',
        'hola,como estas',
        'Good morning house',
        'Greetings from Slackbot',
        'Bonjour,comment ca va?'
    ];

    return greetings[Math.floor(Math.random() * greetings.length)]
}



// to make the bot generate a random joke

function randomJoke() {
    axios.get('https://api.chucknorris.io/jokes/random?science={science}')
      .then(res => {
            const joke = res.data.value;

            const params = {
                icon_emoji: ':smile:'
            }
        
            bot.postMessageToChannel(
                'general',
                `:zap: ${joke}`,
                params
            );

      })
}

// server configuration
app.listen(port, () => {
    console.log('Server is up on port ' + port);
});



