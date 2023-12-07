import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.stream.Collectors;

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
        protected int oxygenGeneratorRate = 0;
        protected int co2ScrubberRate = 0;

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
            calculateOxygenGeneratorRate();
            calculateCo2ScrubberRate();

            result = oxygenGeneratorRate * co2ScrubberRate;

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

        protected void calculateOxygenGeneratorRate() {
            String binaryNuber = commonCalculate("oxygen-generator");
            oxygenGeneratorRate = Integer.parseInt(binaryNuber, 2);
        }

        protected void calculateCo2ScrubberRate() {
            String binaryNumber = commonCalculate("co2-scrubber");
            co2ScrubberRate = Integer.parseInt(binaryNumber, 2);
        }

        protected String commonCalculate(String type) {
            String binaryNumber = "";
            ArrayList<ArrayList<Integer>> matchingNumbers = new ArrayList<>(
                    data.stream().map(x -> new ArrayList<>(x)).collect(Collectors.toList()));

            int columns = data.get(0).size();

            for (int i = 0; i < columns; i++) {
                if (matchingNumbers.size() == 1) {
                    break;
                }

                int criteriaNumber = commonCriteria(type, i);

                for (int j = 0; j < matchingNumbers.size(); j++) {
                    ArrayList<Integer> temp = matchingNumbers.get(j);

                    if (temp.get(i) != criteriaNumber) {
                        matchingNumbers.remove(j);
                        j--;
                    }

                    if (matchingNumbers.size() == 1) {
                        break;
                    }
                }
            }

            if (matchingNumbers.size() == 1) {
                for (ArrayList<Integer> temp : matchingNumbers) {
                    for (Integer number : temp) {
                        binaryNumber += number;
                    }
                }
            }

            return binaryNumber;
        }

        protected int commonCriteria(String type, int column) {
            int result = 0;

            int zero = 0;
            int one = 0;

            for (ArrayList<Integer> line : data) {
                if (line.get(column) == 0) {
                    zero++;
                } else {
                    one++;
                }
            }

            switch (type) {
                case "oxygen-generator":
                    if (one == zero) {
                        result = 1;
                    } else {
                        result = (zero > one) ? 0 : 1;
                    }
                    break;
                case "co2-scrubber":
                    if (one == zero) {
                        result = 0;
                    } else {
                        result = (zero > one) ? 1 : 0;
                    }
                    break;
                default:
                    break;
            }

            return result;
        }
    }
}
