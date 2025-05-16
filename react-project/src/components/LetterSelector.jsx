function LetterSelector({ selectedLetter, onSelectLetter }) {
  return (
    <div>
      {['a', 'b', 'c'].map((letter) => (
        <button
          key={letter}
          onClick={() => onSelectLetter(letter)}
          style={{
            margin: '0.5rem',
            padding: '0.5rem 1rem',
            backgroundColor: selectedLetter === letter ? '#646cff' : '#f9f9f9',
            color: selectedLetter === letter ? '#fff' : '#000',
            border: '1px solid #646cff',
            borderRadius: '5px',
            cursor: 'pointer',
          }}
        >
          {letter.toUpperCase()}
        </button>
      ))}
    </div>
  );
}

export default LetterSelector;