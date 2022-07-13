import Layout from './layout/Layout';
import './App.css';
import {
  Routes,
  Route,
  BrowserRouter,
} from "react-router-dom";
import FoodList from './pages/FoodList';
import CreateAndEdit from './pages/CreateAndEdit';
import Edit from './pages/Edit';
import Count from './pages/Count';
function App() {
  return (
    <BrowserRouter>
    <Routes>
    <Route path="/" element={<Layout/>}>
      <Route path="/" element={<FoodList />} />
      <Route path="/create" element={<CreateAndEdit />} />
      <Route path="/edit/:id" element={<Edit />} />
      <Route path="/count" element={<Count />} />


    </Route>
  </Routes>
  </BrowserRouter>
  );
}

export default App;
