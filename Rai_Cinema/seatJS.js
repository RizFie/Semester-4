let seats = document.querySelector(".all-seat");
      for (var i = 0; i < 12; i++) {
        let booked = false;
        booked === true ? "booked" : "";
        seats.insertAdjacentHTML(
          "beforeend",
          `<input type="checkbox" name="tickets" id="s${i + 1}" data-id="s${i + 1}" />
        <label for="s${i + 1}" class="seat ${booked}"></label>`);
        }

let tickets = seats.querySelectorAll("input")
tickets.forEach((tickets)=>{tickets.addEventListener("change",()=>{
  let amount = document.querySelector(".amount").innerHTML;
  let count = document.querySelector(".count").innerHTML;
  amount = Number(amount);
  count = Number(count);

  let seatId = tickets.getAttribute("data-id");

  if(tickets.checked){
    count+=1;
    amount+=15;
    console.log("Booked seat ID:", seatId);
  }
  else{
    count-=1;
    amount-=15;
    console.log("Unbooked seat ID:", seatId);
  }
  document.querySelector(".amount").innerHTML = amount;
  document.querySelector(".count").innerHTML = count; 
})})

document.addEventListener('DOMContentLoaded', () => {
  const movieName = localStorage.getItem('movieName');
  if (movieName) {
      document.getElementById('movieName').textContent = movieName;
  }
});

if(seats.checked == true){

}

