from sympy import symbols, Eq, solve, Matrix

# Define the variables
x, y = symbols('x y')

# Input the linear equation
equation_str = input("Enter a linear equation (e.g., 2x + 2y = 12): ")

# Parse the input equation
equation = Eq(*map(sympify, equation_str.split('=')))

# Solve the equation for one of the variables
solved_equation = solve(equation, x)

# Construct the augmented matrix
matrix_coefficients = Matrix([[equation.coeff(x), equation.coeff(y), solved_equation[0]]])

# Print the matrix
print("Matrix Form:")
print(matrix_coefficients)
