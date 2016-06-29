/**
 * Generates random particles using canvas
 * 
 * @class Particles
 * @constructor
 */
function Particles(){
  //particle colors
  this.colors = [
    '223, 85, 205',
    '31, 229, 237',
    '51, 246, 176'
  ]
  //adds gradient to particles on true
  this.blurry = true;
  //adds white border
  this.border = false;
  //particle radius min/max
  this.minRadius = 235; 
  this.maxRadius = 265;
  //particle opacity min/max
  this.minOpacity = 0.1;
  this.maxOpacity = 0.3;
  //particle speed min/max
  this.minSpeed = 0.5;
  this.maxSpeed = 2;
  //frames per second 
  this.fps = 60;
  //number of particles
  this.numParticles = 10;
  //required canvas variables
  this.canvas = document.getElementById('canvas');
  this.ctx = this.canvas.getContext('2d');
}

/**
 * Initializes everything
 * @method init
 */
Particles.prototype.init = function(){
  this.render();
  this.createCircle();
}

/**
 * generates random number between min and max values
 * @param  {number} min value
 * @param  {number} max malue
 * @return {number} random number between min and max
 * @method _rand
 */
Particles.prototype._rand = function(min, max){
  return Math.random() * (max - min) + min;
}

/**
 * Sets canvas size and updates values on resize
 * @method render
 */
Particles.prototype.render = function(){ 
  var self = this,
      wHeight = $(window).height(),
      wWidth = $(window).width();
  
  self.canvas.width = wWidth;
  self.canvas.height = wHeight;
  
  $(window).on('resize', self.render);
}

/**
 * Randomly creates particle attributes
 * @method createCircle
 */
Particles.prototype.createCircle = function(){
  var particle = [];

  for (var i = 0; i < this.numParticles; i++) {
    var self = this,
        color = self.colors[~~(self._rand(0, self.colors.length))];
    
    particle[i] = {
      radius    : self._rand(self.minRadius, self.maxRadius),
      xPos      : self._rand(0, canvas.width),
      yPos      : self._rand(0, canvas.height),
      xVelocity : self._rand(self.minSpeed, self.maxSpeed),
      yVelocity : self._rand(self.minSpeed, self.maxSpeed),
      color     : 'rgba(' + color + ',' + self._rand(self.minOpacity, self.maxOpacity) + ')'
    }
    
    //once values are determined, draw particle on canvas
    self.draw(particle, i);
  }
  //...and once drawn, animate the particle
  self.animate(particle);
}

/**
 * Draws particles on canvas
 * @param  {array} Particle array from createCircle method
 * @param  {number} i value from createCircle method
 * @method draw
 */
Particles.prototype.draw = function(particle, i){
  var self = this,
      ctx = self.ctx;
  
  if (self.blurry === true ) {
    //creates gradient if blurry === true
    var grd = ctx.createRadialGradient(particle[i].xPos, particle[i].yPos, particle[i].radius, particle[i].xPos, particle[i].yPos, particle[i].radius/10.75);
    
    grd.addColorStop(1.000, particle[i].color);
    grd.addColorStop(0.000, 'rgba(34, 34, 34, 0)');
    ctx.fillStyle = grd;
  } else {
    //otherwise sets to solid color w/ opacity value
    ctx.fillStyle = particle[i].color; 
  }
  
  if (self.border === true) {
    ctx.strokeStyle = '#fff';
    ctx.stroke();
  }
  
  ctx.beginPath();
  ctx.arc(particle[i].xPos, particle[i].yPos, particle[i].radius, 0, 2 * Math.PI, false);
  ctx.fill();
}

/**
 * Animates particles 
 * @param  {array} particle value from createCircle & draw methods
 * @method animate
 */
Particles.prototype.animate = function(particle){
  var self = this,
          ctx = self.ctx;
  
  setInterval(function(){
    //clears canvas
    self.clearCanvas();
    //then redraws particles in new positions based on velocity
    for (var i = 0; i < self.numParticles; i++) {
      particle[i].xPos += particle[i].xVelocity;
      particle[i].yPos -= particle[i].yVelocity;
     
      //if particle goes off screen call reset method to place it offscreen to the left/bottom
      if (particle[i].xPos > self.canvas.width + particle[i].radius || particle[i].yPos > self.canvas.height + particle[i].radius) {
        self.resetParticle(particle, i);
      } else {
        self.draw(particle, i);
      }
    }  
  }, 1000/self.fps); 
}

/**
 * Resets position of particle when it goes off screen
 * @param  {array} particle value from createCircle & draw methods
 * @param  {number} i value from createCircle method
 * @method resetParticle
 */
Particles.prototype.resetParticle = function(particle, i){
  var self = this;
  
  var random = self._rand(0, 1);
  
  if (random > .5) { 
    // 50% chance particle comes from left side of window...
    particle[i].xPos = -particle[i].radius;
    particle[i].yPos = self._rand(0, canvas.height);
  } else {
    //... or bottom of window
    particle[i].xPos = self._rand(0, canvas.width);
    particle[i].yPos = canvas.height + particle[i].radius;   
  }
  //redraw particle with new values
  self.draw(particle, i);
}

/**
 * Clears canvas between animation frames
 * @method clearCanvas
 */
Particles.prototype.clearCanvas = function(){
  this.ctx.clearRect(0, 0, canvas.width, canvas.height);
}

 
// go go go!
var particle = new Particles().init();

//var song, analyzer;
//
//function preload() {
//  song = loadSound('../incredibox-566DA75BC2507-V2.wav');
//}
//
//function setup() {
//  createCanvas(710, 200);
//  song.loop();
//
//  // create a new Amplitude analyzer
//  analyzer = new p5.Amplitude();
//
//  // Patch the input to an volume analyzer
//  analyzer.setInput(song);
//}
//
//function draw() {
//  background(255);
//
//  // Get the average (root mean square) amplitude
//  var rms = analyzer.getLevel();
//  fill(127);
//  stroke(0);
//
//  // Draw an ellipse with size based on volume
//  ellipse(width/2, height/2, 10+rms*200, 10+rms*200);
//}
//Il faut dl P5 en passant par ce lien : https://p5js.org/examples/examples/Sound__Measuring_Amplitude.php


// Code pour l'infographie des scores

function dynamicBarScore() {
  var bass = parseInt($('.content__experiencepre--bass span' ).text());
  var pads = parseInt($('.content__experiencepre--pads span' ).text());
  var drum = parseInt($('.content__experiencepre--drum span' ).text());
  var lead = parseInt($('.content__experiencepre--lead span' ).text());

  var total = bass + pads + drum + lead;

  function crossProduct( value, base) {
    var result = value * 100 / base;
    return result +'%';
  }

  function widthis(elementname, value, total){

    $('.content__experience--'+ elementname ).width( crossProduct(value, total ) );
    $('.content__experiencepre--'+ elementname ).width( crossProduct(value, total ) );

  }
  widthis('bass', bass, total);
  widthis('pads', pads, total);
  widthis('drum', drum, total);
  widthis('lead', lead, total);




}
dynamicBarScore();