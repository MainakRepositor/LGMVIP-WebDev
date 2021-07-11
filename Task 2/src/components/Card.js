import React from 'react';
import './card.css';
const Card = ({ name, email, id, lname}) => {
  //Displays all the information in a card format
    return (
      <div className='tc grow bg-light-blue br2 pa5 ma3 dib bw2 shadow-10' id='card'>
        <img alt='robots' id="image" src={`https://reqres.in/img/faces/${id}-image.jpg`} />
        <div>
		  <br />
          <h2>{name} {lname}</h2>
		  <br />
          <h3>{email}</h3>
        </div>
      </div>
    );
  }

export default Card;
