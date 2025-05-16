import { useState, useEffect } from 'react';
import './App.css';
import Meals from './components/Meals';
import LetterSelector from './components/LetterSelector';

function App() {
  const [selectedLetter, setSelectedLetter] = useState('a');
  const [meals, setMeals] = useState([]);

  useEffect(() => {
    const fetchMeals = async () => {
      try {
        const response = await fetch(
          `https://www.themealdb.com/api/json/v1/1/search.php?f=${selectedLetter}`
        );
        const data = await response.json();
        setMeals(data.meals || []);
      } catch (error) {
        console.error('Error fetching meals:', error);
      }
    };

    fetchMeals();
  }, [selectedLetter]);

  return (
    <div>
      <h1>ABC Restaurant</h1>
      <LetterSelector
        selectedLetter={selectedLetter}
        onSelectLetter={setSelectedLetter}
      />
      <Meals meals={meals} />
    </div>
  );
}

export default App;
