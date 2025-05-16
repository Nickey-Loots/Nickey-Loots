import { useState } from 'react';
import pencilIcon from '../assets/pencil.jpg';

function Dish({ meal }) {
  const [title, setTitle] = useState(meal.strMeal);

  const handleEditTitle = () => {
    const newTitle = prompt('Enter a new title for the dish:', title);
    if (newTitle) {
      setTitle(newTitle);
    }
  };

  return (
    <article>
      <h2>{title}</h2>
      <img src={meal.strMealThumb} alt={meal.strMeal} />
      <p>{meal.strInstructions}</p>
      <img
        src={pencilIcon}
        alt="Edit title"
        style={{ cursor: 'pointer', width: '20px', height: '20px' }}
        onClick={handleEditTitle}
      />
    </article>
  );
}

export default Dish;