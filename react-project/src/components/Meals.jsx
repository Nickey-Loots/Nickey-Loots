import Dish from './Dish';

function Meals({ meals }) {
  return (
    <section>
      {meals.map((meal) => (
        <Dish key={meal.idMeal} meal={meal} />
      ))}
    </section>
  );
}

export default Meals;