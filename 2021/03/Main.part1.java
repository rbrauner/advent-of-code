import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;

class Main {
    public static void main(String args[]) throws IOException {
        Main main = new Main();
        App app = main.new App();
        app.run();
    }

    class App {
        // common
        protected String input;
        protected String[] split;

        // task specified
        protected ArrayList<ArrayList<Integer>> data;
        protected int gammaRate = 0;
        protected int epsilonRate = 0;

        App() {
            // common
            try {
                input = new String(Files.readAllBytes(Paths.get("input.txt"))).strip();
                split = input.split("\n");
            } catch (Exception e) {
            }

            // task specified
            data = new ArrayList<ArrayList<Integer>>();
        }

        public void run() {
            long result = 0;

            fillData();
            calculateGammaRate();
            calculateEpsilonRate();

            result = gammaRate * epsilonRate;

            System.out.println("Result: " + result);
        }

        protected void fillData() {
            for (String element : split) {
                ArrayList<Integer> line = new ArrayList<Integer>();
                for (char c : element.toCharArray()) {
                    line.add(Character.getNumericValue(c));
                }
                data.add(line);
            }
        }

        protected void calculateGammaRate() {
            String binaryNumber = "";

            int columns = data.get(0).size();
            int zero = 0;
            int one = 0;

            for (int i = 0; i < columns; i++) {
                zero = 0;
                one = 0;

                for (ArrayList<Integer> line : data) {
                    if (line.get(i) == 0) {
                        zero++;
                    } else {
                        one++;
                    }
                }

                binaryNumber += (zero > one) ? "0" : "1";
            }

            gammaRate = Integer.parseInt(binaryNumber, 2);
        }

        protected void calculateEpsilonRate() {
            String binaryNumber = "";

            int columns = data.get(0).size();
            int zero = 0;
            int one = 0;

            for (int i = 0; i < columns; i++) {
                zero = 0;
                one = 0;

                for (ArrayList<Integer> line : data) {
                    if (line.get(i) == 0) {
                        zero++;
                    } else {
                        one++;
                    }
                }

                binaryNumber += (zero < one) ? "0" : "1";
            }

            epsilonRate = Integer.parseInt(binaryNumber, 2);
        }
    }
}
