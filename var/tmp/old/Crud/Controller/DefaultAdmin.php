<?php

class Crud_Controller_DefaultAdmin extends Aula_Controller_Action {

	//main variables
	protected $_tables = array();
	protected $_columns = array();
	protected $_selectedTables = array();
	protected $_selectedColumns = array();
	protected $_columnsMeta = array();
	protected $_columnsArrayFormat = array();
	protected $_columnsSelectQueryFormat = array();
	protected $_primaryKey = array();
	protected $_foreignKeys = array();
	protected $_referenceMap = array();
	protected $_dependentTables = array();

	//templates
	protected $_modelTemplate = '';
	protected $_controllerTemplate = '';
	protected $_viewListTemplate = '';
	protected $_viewItemTemplate = '';
	protected $_addItemTemplate = '';

	//custom names and paths for files
	protected $_modelClassNamePrefex = '';
	protected $_modelClassNameMiddle = '_Model_';
	protected $_modelClassNamePostfex = 'Default';
	protected $_modelFileNamePrefex = '';
	protected $_modelFileNamePostfex = '';
	protected $_modelFileFullPath = '';
	protected $_controllerClassNamePrefex = '';
	protected $_ontrollerClassNamePostfex = '_Controller_DefaultAdmin';
	protected $_ontrollerClassNameMiddle = '';
	protected $_controllerFileNamePrefex = '';
	protected $_controllerFileNamePostfex = '';
	protected $_controllerFileFullPath = '';

	private $_columnAliasMap = array();

	protected function _init() {
		$this -> defualtAdminAction = 'list';
		$this -> view -> sanitized = $_POST;
		$this -> view -> _init();
		$this -> fields = array('actionURI' => array('uri', 0), 'redirectURI' => array('uri', 0, ''), 'token' => array('text', 1), 'notification' => array('', 0), 'success' => array('', 0), 'error' => array('', 0), 'btn_submit' => array('', 0, 2));
		$this -> view -> sanitized = $this -> filterObj -> initData($this -> fields, $this -> view -> sanitized);
		$this -> view -> sanitized['token']['value'] = md5(time() . 'qwiedkhjsafg');
		$this -> view -> sanitized['locale']['value'] = 1;

		$this -> _initTablesList();
		$this -> _initColumnsAliasMap();
		$this -> _initAllKeysAndMetaInfo();
		$this -> _initTemplates();
		
		/*
		foreach ($this->_columnsMeta as $table) {
			foreach ($table as $col=>$meta) {
				$DEFAULT[]=$meta['DEFAULT'];
			}
		}
		print_r(array_unique($DEFAULT));die;
		 */
	}

	private function _initTablesList() {
		$this -> view -> tables = $this -> _tables = Aula_Model_Db::$connection -> listTables();
	}

	private function _initColumnsAliasMap() {
		$this -> _columnAliasMap['author_id'] = 'user_id';
		$this -> _columnAliasMap['owner_id'] = 'user_id';
		$this -> _columnAliasMap['parent_id'] = 'PRIMARY_KEY';
		$this -> _columnAliasMap['reference_id'] = 'PRIMARY_KEY';
		$this -> _columnAliasMap['locked_by'] = 'user_id';
		$this -> _columnAliasMap['modified_by'] = 'user_id';
	}

	private function _initAllKeysAndMetaInfo() {
		foreach ($this->_tables as $table) {
			//get columns for this table
			$columns = Aula_Model_Db::$connection -> describeTable($table);

			//initialize this table standard columns list in array format
			$this -> _columnsArrayFormat[$table] = '';

			//initialize this table standard select query
			$this -> _columnsSelectQueryFormat[$table] = ' SQL_CALC_FOUND_ROWS ';

			foreach ($columns as $column => $columnMeta) {
				//standarize columns char format in lower case and trimmed
				$column = strtolower(trim($column));

				//add current column meta data/info to this table meta info
				$this -> _columnsMeta[$table][] = $columnMeta;

				//add current column name to this table columns array
				$this -> _columns[$table][] = $column;
				
				//add current column name to this table standard array list
				$this -> _columnsArrayFormat[$table] .= '\'' . $column . '\', ';

				//add current column name to this table standard select query
				$this -> _columnsSelectQueryFormat[$table] .= '`' . $column . '`, ';

				//check if this column is the primary key, of sp; add to primary columns array
				if ($columnMeta['PRIMARY'] == 1) {
					$this -> _primaryKey[$table][] = $column;
				}
				// else, check if column ends with _id
				else if (FALSE !== strcmp('_id', substr($column, -3))) {
					$this -> _checkIfForeignKey($table, $column);
				}
				//check if column is alias to an original column, such as "author_id" is alias to "user_id"
				if (array_key_exists($column, $this -> _columnAliasMap)) {
					//check if the stored alias is a foreign key within the same table
					//sill be used to inner join within the same table
					//such case is parent_id column
					if (0 === strcmp($this -> _columnAliasMap[$column], 'PRIMARY_KEY')) {
						$alias = $table . '_' . $this -> _primaryKey[$table][0];
					} else {
						$alias = $this -> _columnAliasMap[$column];
					}
					$this -> _checkIfForeignKey($table, $alias, $column);
				}
			}
			$this -> _columnsArrayFormat[$table] = trim($this -> _columnsArrayFormat[$table], ', ');
			$this -> _columnsSelectQueryFormat[$table] = trim($this -> _columnsSelectQueryFormat[$table], ', ');
		}
	}

	private function _initTemplates() {
		$this -> _modelTemplate = $this -> view -> load("crud/model.phtml");
		$this -> _controllerTemplate = $this -> view -> load("crud/controller.phtml");
	}

	private function _checkIfForeignKey($table, $column, $alias = false) {
		if (false === $alias) {
			$alias = $column;
		}

		//extra case to check in case column name missed the full table name
		$tableAliasMap = explode('_', $table);

		//check if this column is foreign key, hence a primary key in another table
		if (in_array(substr($column, 0, -3), $this -> _tables)) {
			$this -> _setForeignKey($table, substr($column, 0, -3), $alias);
			return;
		}
		//check if this column belong to a table within the same module. For example column 'type_id' is a foreign key and belongs to category_type table
		else if (in_array(substr($table . '_' . $column, 0, -3), $this -> _tables) and (FALSE === strcmp('id', $column))) {
			$this -> _setForeignKey($table, substr($table . '_' . $column, 0, -3), $alias);
			return;
		}
		//check table alias
		if (is_array($tableAliasMap)) {
			foreach ($tableAliasMap as $tableAlias) {
				$tableAliasSwap = $tableAlias .= '_';
				if (in_array(substr($tableAlias . $column, 0, -3), $this -> _tables)) {
					$this -> _setForeignKey($table, substr($tableAlias . $column, 0, -3), $alias);
					continue;
				}
			}
			if (in_array(substr($tableAliasSwap . $column, 0, -3), $this -> _tables)) {
				$this -> _setForeignKey($table, substr($tableAliasSwap . $column, 0, -3), $alias);
				continue;
			}
		}
	}

	private function _setForeignKey($table, $column, $alias) {
		$this -> _foreignKeys[$table][$column][] = $alias;
	}

	private function _printModelTemplate($table) {
		$dependentTables = '';
		$toClass = new Zend_Filter_Inflector(':tbl', array(':tbl' => array('StringToLower', 'Word_UnderscoreToCamelCase')));

		foreach ($this->_foreignKeys as $key => $value1) {
			if (array_key_exists($table, $value1)) {
				$className = explode('_', $key);
				if (empty($className[1])) {
					$className[1] = $this -> _modelClassNamePostfex;
				}
				$className = $this -> _modelClassNamePrefex . $toClass -> filter(array('tbl' => array_shift($className))) . $this -> _modelClassNameMiddle . $toClass -> filter(array('tbl' => join('_', $className)));
				$dependentTables .= '"' . $className . '", ';
			}
		}
		$dependentTables = trim($dependentTables, "', ");
		$className = explode('_', $table);
		if (empty($className[1])) {
			$className[1] = $this -> _modelClassNamePostfex;
		}
		$className = $this -> _modelClassNamePrefex . $toClass -> filter(array('tbl' => array_shift($className))) . $this -> _modelClassNameMiddle . $toClass -> filter(array('tbl' => join('_', $className)));
		printf($this -> _modelTemplate, $className, $table, $this -> _primaryKey[$table][0], $dependentTables, '', $this -> _columnsArrayFormat[$table], $this -> _columnsSelectQueryFormat[$table]);
	}

	private function _printControllerTemplate($table) {
		$dependentTables = '';
		$toClass = new Zend_Filter_Inflector(':tbl', array(':tbl' => array('StringToLower', 'Word_UnderscoreToCamelCase')));

		foreach ($this->_foreignKeys as $key => $value1) {
			if (array_key_exists($table, $value1)) {
				$className = explode('_', $key);
				if (empty($className[1])) {
					$className[1] = $this -> _modelClassNamePostfex;
				}
				$className = $this -> _modelClassNamePrefex . $toClass -> filter(array('tbl' => array_shift($className))) . $this -> _modelClassNameMiddle . $toClass -> filter(array('tbl' => join('_', $className)));
				$dependentTables .= '"' . $className . '", ';
			}
		}
		$dependentTables = trim($dependentTables, "', ");
		$className = explode('_', $table);
		if (empty($className[1])) {
			$className[1] = $this -> _modelClassNamePostfex;
		}
		$className = $this -> _modelClassNamePrefex . $toClass -> filter(array('tbl' => array_shift($className))) . $this -> _modelClassNameMiddle . $toClass -> filter(array('tbl' => join('_', $className)));
		printf($this -> _modelTemplate, $className, $table, $this -> _primaryKey[$table][0], $dependentTables, '', $this -> _columnsArrayFormat[$table], $this -> _columnsSelectQueryFormat[$table]);
	}

	private function _printViewTemplates($table) {
		$dependentTables = '';
		$toClass = new Zend_Filter_Inflector(':tbl', array(':tbl' => array('StringToLower', 'Word_UnderscoreToCamelCase')));

		foreach ($this->_foreignKeys as $key => $value1) {
			if (array_key_exists($table, $value1)) {
				$className = explode('_', $key);
				if (empty($className[1])) {
					$className[1] = $this -> _modelClassNamePostfex;
				}
				$className = $this -> _modelClassNamePrefex . $toClass -> filter(array('tbl' => array_shift($className))) . $this -> _modelClassNameMiddle . $toClass -> filter(array('tbl' => join('_', $className)));
				$dependentTables .= '"' . $className . '", ';
			}
		}
		$dependentTables = trim($dependentTables, "', ");
		$className = explode('_', $table);
		if (empty($className[1])) {
			$className[1] = $this -> _modelClassNamePostfex;
		}
		$className = $this -> _modelClassNamePrefex . $toClass -> filter(array('tbl' => array_shift($className))) . $this -> _modelClassNameMiddle . $toClass -> filter(array('tbl' => join('_', $className)));
		printf($this -> _modelTemplate, $className, $table, $this -> _primaryKey[$table][0], $dependentTables, '', $this -> _columnsArrayFormat[$table], $this -> _columnsSelectQueryFormat[$table]);
	}

	public function printTemplatesAction() {
		foreach ($this->_tables as $table) {
			$this -> _printModelTemplate($table);
			$this -> _printControllerTemplate($table);
			$this -> _printViewTemplates($table);
		}
	}

	public function listTableColumnsAction() {
		$html = '';
		if (!empty($_GET['table']) and in_array($_GET['table'], $this -> _tables)) {
			$table = $_GET['table'];
		} else {
			echo json_encode('Error loading table info');
			exit();
		}
		echo json_encode($this->_columnsMeta[$table]);
		exit ;
	}

	public function listAction() {
		$this -> view -> arrayToObject($this -> view -> sanitized);
		$this -> view -> render('crud/default.phtml');
		exit();
	}

}
